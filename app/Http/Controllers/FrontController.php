<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'teacher', 'students'])->orderByDesc('created_at')->get();
        return view('front.index', compact('courses'));
    }

    public function details(Course $course)
    {

        return view('front.details', compact(['course']));
    }

    public function learning(Course $course, $courseVideoId)
    {
        $user = Auth::user();
        if (!$user->hasRole('owner') && !$user->hasActiveSubscription()) {
            return redirect()->route('front.pricing');
        }

        $video = $course->course_videos()->where('id', $courseVideoId)->first();
        // $video = $course->course_videos()->firstWhere('id', $courseVideoId); // cari video berdasarkan id lewat course dan relas course_videos
        if (!$video) {
            return abort(404);
        }
        if (!$user->hasRole('owner')) {
            $user->courses()->syncWithoutDetaching($course->id); // masukin ke db transaksi subscribe_transaction
        }


        return view('front.learning', [
            'course' => $course,
            'video' => $video
        ]);
    }
}
