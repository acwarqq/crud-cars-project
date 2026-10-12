@extends('layouts.app')

@section('title', 'Car list')

@section('content')
    <p><a href="{{ route('cars.create') }}">Add a new record</a></p>
    <form method="GET" action="{{ route('cars.index') }}" style="margin-bottom: 1rem">
        <label>Brand
            <select name="brand">
                <option value="">All brands</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand }}" @selected(request('brand') === $brand)>{{ $brand }}</option>
                @endforeach
            </select>
        </label>
        <button type="submit">Filter</button>
        @if (request('brand'))
            <a href="{{ route('cars.index') }}">Reset</a>
        @endif
    </form>
    <table>
        <tr>
            <th>Brand</th><th>Model</th><th>Released</th>
            <th>Body type</th><th>Price, USD</th><th>Available</th><th></th>
        </tr>
        @forelse ($cars as $car)
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

    {{ $cars->links() }}
@endsection