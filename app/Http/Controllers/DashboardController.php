<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\SubscribeTransaction;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // siapkan data user yang sedang login
        $coursesQuery = Course::query(); // query itu bakal ada query lanjutan
        if ($user->hasRole('teacher')) {
            $coursesQuery->whereHas('teacher', function ($query) use ($user) {
                $query->where('user_id', $user->id); //memfilter kursus-kursus sehingga hanya kursus yang diajar oleh guru yang sedang login yang akan diambil.
            });  //$coursesQuery->select('id')

            // hanya menghitung student yang di ajar guru yg sdg login
            $students = CourseStudent::whereIn('course_id', $coursesQuery->select('id'))->distinct('user_id')->count('user_id');
        } else {
            // kalo ini menghitung semua user yang masuk kelas
            $students = CourseStudent::distinct('user_id')->count('user_id');
        }

        $courses = $coursesQuery->count();
        $categories = Category::count();
        $transactions = SubscribeTransaction::count();
        $teachers = Teacher::count();

        return view('dashboard', compact('courses', 'students', 'categories', 'transactions', 'teachers'));
    }
}
