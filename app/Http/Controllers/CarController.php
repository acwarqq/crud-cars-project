<?php

namespace App\Http\Controllers;

use App\Models\BodyType;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $brands = Car::select('brand')->distinct()->orderBy('brand')->pluck('brand');

        $cars = Car::with('bodyType')
            ->when($request->filled('brand'), fn ($query) => $query->where('brand', $request->brand))
            ->orderByDesc('id')
            ->paginate(5)
            ->withQueryString();

        return view('cars.index', compact('cars', 'brands'));
    }

    public function create()
    {
        $bodyTypes = BodyType::orderBy('name')->get();

        return view('cars.create', compact('bodyTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        Car::create($data);

        return redirect()->route('cars.index')->with('success', 'Car added.');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $bodyTypes = BodyType::orderBy('name')->get();

        return view('cars.edit', compact('car', 'bodyTypes'));
    }

    public function update(Request $request, Car $car)
    {
        $data = $request->validate($this->rules());

        $car->update($data);

        return redirect()->route('cars.show', $car)->with('success', 'Car updated.');
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted.');
    }

    private function rules(): array
    {
        return [
            'brand'               => ['required', 'string', 'max:50'],
            'model'               => ['required', 'string', 'max:50'],
            'release_year'        => ['required', 'integer', 'between:1886,' . date('Y')],
            'release_month'       => ['required', 'integer', 'between:1,12'],
            'price'               => ['required', 'integer', 'min:0'],
            'engine_displacement' => ['nullable', 'numeric', 'between:0,99.9'],
            'is_available'        => ['required', 'boolean'],
            'body_type_id'        => ['required', 'exists:body_types,id'],
        ];
    }
}