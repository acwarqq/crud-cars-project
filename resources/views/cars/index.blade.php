@extends('layouts.app')

@section('title', 'Car list')

@section('content')
    <p><a href="{{ route('cars.create') }}">Add a car</a></p>

    <table>
        <tr>
            <th>Brand</th><th>Model</th><th>Released</th>
            <th>Body type</th><th>Price, USD</th><th>Available</th><th></th>
        </tr>
        @forelse ($cars as $car)
        <!-- stas zhir ti -->
            <tr>
                <td>{{ $car->brand }}</td>
                <td>{{ $car->model }}</td>
                <td>{{ sprintf('%02d', $car->release_month) }}/{{ $car->release_year }}</td>
                <td>{{ $car->bodyType->name }}</td>
                <td>{{ number_format($car->price) }}</td>
                <td>{{ $car->is_available ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('cars.show', $car) }}">View</a>
                    <a href="{{ route('cars.edit', $car) }}">Edit</a>
                    <form method="POST" action="{{ route('cars.destroy', $car) }}"
                          style="display:inline"
                          onsubmit="return confirm('Delete this car?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">No records yet</td></tr>
        @endforelse
    </table>
@endsection