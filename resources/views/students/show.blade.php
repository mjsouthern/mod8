@extends('layouts.app')
@section('title', "Show Student Information")
@section('content')
    <h1>Student Details</h1>
    <p>Name: <span style="text-decoration: underline">{{ $student->name }}</span></p>
    <p>Course: <span style="text-decoration: underline">{{ $student->course }}</span></p>
@endsection