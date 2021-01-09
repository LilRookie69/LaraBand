@extends('layouts.backend')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Genres</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bands as $band)
        <tr>
            <td>{{ $bands->count() * ($bands->currentPage() - 1) + $loop->iteration }}</td>
            <td>{{ $band->name }}</td>
            <td>{{ $band->genres()->get()->implode('name',', ') }}</td>
            <td>
                <a href="" class="btn btn-outline-success">Edit</a>
                <a href="" class="btn btn-outline-danger">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{--
    untuk membuat pagination, kalo stylenya ga masuk trus jadi aneh wajar
    karna bawaannya laravel 8 itu tailwind bukan bootstrap jadi harus
    di ganti dulu di /app/Providers/AppServiceProvider di bagian
    function bootnya tambahkan paginator bootstrap
--}}
{{ $bands->links() }}
@endsection
