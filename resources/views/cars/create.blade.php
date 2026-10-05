@extends('layouts.app')

@section('title', 'Add a car')

@section('content')
    <h2>Add a car</h2>

    <form method="POST" action="{{ route('cars.store') }}">
        @csrf
        @include('cars._form')
        <button type="submit">Save</button>
        <a href="{{ route('cars.index') }}">Cancel</a>
    </form>
@endsection