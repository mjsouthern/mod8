<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $action = 'Add';
        return view('students.create_edit', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $validated = $request->validated();
        Student::create($validated);
        return redirect()->route('students.index')->with('success', 'New Student Record Successfully Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $action = 'Update';
        $data = Student::find($student->id);
        return view('students.create_edit', compact('action','data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentRequest $request, Student $student)
    {
        $validated = $request->validated();
        Student::find($student->id)->update($validated);
        return redirect()->route('students.index')->with('success', 'New Student Record Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        Student::find($student->id)->delete();
        return redirect()->route('students.index')->with('success', 'New Student Record Deleted Successfully!');
    }
}
