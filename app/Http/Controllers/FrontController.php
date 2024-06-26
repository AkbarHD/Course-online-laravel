<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeTransactionRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\SubscribeTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $courses = Course::with(['category', 'teacher', 'students'])->orderByDesc('created_at')->get();
        return view('front.index', compact('courses', 'categories'));
    }

    public function details(Course $course)
    {

        return view('front.details', compact(['course']));
    }

    public function category(Category $category)
    {
        $courses = $category->courses()->get();
        return view('front.category', compact('courses', 'category'));
    }

    public function checkout()
    {

        return view('front.checkout');
    }

    public function checkout_store(StoreSubscribeTransactionRequest $request)
    {
        $user = Auth::user();
        DB::transaction(function () use ($request, $user) {

            $validated = $request->validated();
            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }
            $validated['user_id'] = $user->id;
            $validated['total_amount'] = 50000;
            $validated['is_paid'] = false;

            $transaction = SubscribeTransaction::create($validated);

        });

        return redirect()->route('dashboard');
    }

    public function learning(Course $course, $courseVideoId)
    {
        $user = Auth::user();
        $isOwnerOrCreator = $user->hasRole('owner') || ($user->hasRole('teacher') && $course->teacher->user_id === $user->id);
        if (!$isOwnerOrCreator && !$user->hasActiveSubscription()) {
            return redirect()->route('front.pricing');
        }

        $video = $course->course_videos()->where('id', $courseVideoId)->first();
        // $video = $course->course_videos()->firstWhere('id', $courseVideoId); // cari video berdasarkan id lewat course dan relas course_videos
        if (!$video) {
            return abort(404);
        }
        if (!$user->hasRole('owner')) {
            $user->courses()->syncWithoutDetaching($course->id); // masukin ke course_students
        }


        return view('front.learning', [
            'course' => $course,
            'video' => $video
        ]);
    }

    public function pricing()
    {
        return view('front.pricing');
    }
}
