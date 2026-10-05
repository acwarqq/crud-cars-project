@extends('layouts.app')

@section('title', 'Edit ' . $car->brand . ' ' . $car->model)

@section('content')
    <h2>Edit {{ $car->brand }} {{ $car->model }}</h2>

    <form method="POST" action="{{ route('cars.update', $car) }}">
        @csrf
        @method('PUT')
        @include('cars._form')
        <button type="submit">Update</button>
        <a href="{{ route('cars.show', $car) }}">Cancel</a>
    </form>
@endsection