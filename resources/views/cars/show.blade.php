@extends('layouts.app')

@section('title', $car->brand . ' ' . $car->model)

@section('content')
    <h2>{{ $car->brand }} {{ $car->model }}</h2>

    <table>
        <tr><th>Brand</th><td>{{ $car->brand }}</td></tr>
        <tr><th>Model</th><td>{{ $car->model }}</td></tr>
        <tr><th>Released</th><td>{{ sprintf('%02d', $car->release_month) }}/{{ $car->release_year }}</td></tr>
        <tr><th>Body type</th><td>{{ $car->bodyType->name }}</td></tr>
        <tr><th>Price on launch, USD</th><td>{{ number_format($car->price) }}</td></tr>
        <tr><th>Engine displacement, L</th><td>{{ $car->engine_displacement ?? '—' }}</td></tr>
        <tr><th>Available for sale</th><td>{{ $car->is_available ? 'Yes' : 'No' }}</td></tr>
    </table>

    <p>
        <a href="{{ route('cars.index') }}">Back to list</a>
        <a href="{{ route('cars.edit', $car) }}">Edit</a>
    </p>

    <form method="POST" action="{{ route('cars.destroy', $car) }}"
          onsubmit="return confirm('Delete this car?')">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection