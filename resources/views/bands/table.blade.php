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
            <td>{{ ($bands->currentPage() - 1) * $bands->perPage() + $loop->iteration }}</td>
            <td>{{ $band->name }}</td>
            <td>{{ $band->genres()->get()->implode('name',', ') }}</td>
            <td>
                {{--
                    untuk route bisa $band->slug tapi karna sudah di identify di route {band:slug},
                    maka data yang di get url otomatis menjadi slug, jadi cukup $band saja.
                --}}
                <a href="{{ route('bands.edit', $band) }}" class="btn btn-outline-success">Edit</a>
                <div endpoint="{{ route('bands.delete', $band) }}" class="delete d-inline"></div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $bands->links() }}
{{--
    untuk paginate kalo dia datanya ga ke show coba di buat di controllernya jadi paginate(1)
    trus data minimal 2,soalnya dia kalo datanya kaga banyak dia ga muncul
--}}
{{--
    untuk membuat pagination, kalo stylenya ga masuk trus jadi aneh wajar
    karna bawaannya laravel 8 itu tailwind bukan bootstrap jadi harus
    di ganti dulu di /app/Providers/AppServiceProvider di bagian
    function bootnya tambahkan paginator bootstrap
--}}
@endsection
