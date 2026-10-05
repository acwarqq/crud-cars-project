@if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<p>
    <label>Brand<br>
        <input type="text" name="brand" value="{{ old('brand', $car->brand ?? '') }}">
    </label>
</p>
<p>
    <label>Model<br>
        <input type="text" name="model" value="{{ old('model', $car->model ?? '') }}">
    </label>
</p>
<p>
    <label>Release year<br>
        <input type="number" name="release_year" value="{{ old('release_year', $car->release_year ?? '') }}">
    </label>
</p>
<p>
    <label>Release month (1-12)<br>
        <input type="number" name="release_month" value="{{ old('release_month', $car->release_month ?? '') }}">
    </label>
</p>
<p>
    <label>Price on launch, USD<br>
        <input type="number" name="price" value="{{ old('price', $car->price ?? '') }}">
    </label>
</p>
<p>
    <label>Engine displacement, L (optional)<br>
        <input type="number" step="0.1" name="engine_displacement" value="{{ old('engine_displacement', $car->engine_displacement ?? '') }}">
    </label>
</p>
<p>
    <label>Body type<br>
        <select name="body_type_id">
            <option value="">— choose —</option>
            @foreach ($bodyTypes as $type)
                <option value="{{ $type->id }}" @selected(old('body_type_id', $car->body_type_id ?? '') == $type->id)>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </label>
</p>
<p>
    <input type="hidden" name="is_available" value="0">
    <label>
        <input type="checkbox" name="is_available" value="1" @checked(old('is_available', $car->is_available ?? true))>
        Available for sale
    </label>
</p>