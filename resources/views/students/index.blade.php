@extends('layouts.app')
@section('title', 'Student Information')
@section('content') 
    <h1>Student Information</h1>
    @if(session('success'))
        <x-alert-component message="{{ session('success') }}"/>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Course</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <th scope="row">{{ $student->id }}</th>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->course }}</td>
                    <td>
                        <a href={{ route('students.show', ['student' => $student->id]) }} class="btn btn-secondary">View Details</a>
                        <a href={{ route('students.edit', ['student' => $student->id]) }} class="btn btn-primary">Edit</a>
                        <form action={{ route('students.destroy', ['student' => $student->id] ) }} method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('students.create') }}">Register Student</a>
@endsection