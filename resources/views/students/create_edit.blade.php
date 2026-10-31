@extends('layouts.app')
@section('title', "{$action} Student Information")
@section('content')
    <h1>{{ $action }} Student Information</h1>
        <form action="{{ $action == 'Update' ? route('students.update', ['student' => $data->id]) : route('students.store') }}" method="POST" novalidate>
        @csrf

        @if($action == 'Update')
            @method('PUT')
        @endif

        <div class="form-group my-2">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $action == 'Update' ? $data->name : old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group my-2">
            <label for="course">Course</label>
            <input type="text" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ $action == 'Update' ? $data->course : old('course') }}">
            @error('course')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary my-2">Submit</button>
        <button type="reset" class="btn btn-danger my-2">Cancel</button>
    </form>
@endsection