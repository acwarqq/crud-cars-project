<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Cars')</title>
    <style>
        body { font-family: sans-serif; max-width: 900px; margin: 2rem auto; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: .4rem .6rem; text-align: left; }
        .flash { background: #dff0d8; padding: .6rem; margin-bottom: 1rem; }
        .pagination { list-style: none; display: flex; gap: .3rem; padding: 0; margin-top: 1rem; }
        .pagination .page-link { display: block; border: 1px solid #ccc; padding: .3rem .6rem; text-decoration: none; }
        .pagination .active .page-link { background: #333; color: #fff; }
        .pagination .disabled .page-link { color: #999; }
        .error { color: #b00; }
    </style>
</head>
<body>
    <h1><a href="{{ route('cars.index') }}">Cars</a></h1>

    @if (session('success'))
        <div class="flash">{{ session('success') }}</div>
    @endif

    @yield('content')
</body>
</html>