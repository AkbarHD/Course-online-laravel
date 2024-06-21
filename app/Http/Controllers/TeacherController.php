<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('id', 'DESC')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email anda tidak terdaftar',
            ]);
        }

        if ($user->hasAnyRole('teacher')) {
            return back()->withErrors([
                'email' => 'Email ini sudah terdaftar sebagai guru',
            ]);
        }

        DB::transaction(function () use ($user, $validated) {
            $validated['user_id'] = $user->id;
            $validated['is_active'] = true;

            Teacher::create($validated);

            if ($user->hasRole('student')) {
                $user->removeRole('student');
            }
            $user->assignRole('teacher');
        });

        return redirect()->route('admin.teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try {
            $teacher->delete();
            $user = User::find($teacher->user_id);
            $user->removeRole('teacher');
            $user->assignRole('student');
            return redirect()->route('admin.teachers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['system error' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
