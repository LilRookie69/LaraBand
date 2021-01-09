@extends('layouts.backend')
@push('scripts')
<script>
    $(document).ready(function() {
    $('.select2multiple').select2();
});
</script>
@endpush
@section('content')
@include('alert')
<div class="card">
    <div class="card-header">Edit Band Info</div>
    <div class="card-body">
        <form action="{{ route('bands.edit', $band) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail"
                    class="form-control-file @error('thumbnail') is-invalid @enderror">
                @error('thumbnail')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') ?? $band->name }}"
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="genres">Choose Genre</label>
                <select name="genres[]" id="genres"
                    class="form-control select2multiple @error('genres') is-invalid @enderror" multiple>
                    @foreach ($genres as $genre)
                    {{--
                        band sudah terselect dari get id nya ($band), panggil fungsi genre (genre()) buat manggil genrenya, terus kan ada relasi
                        many to many ya buat ngehubungin band apa punya genre apa nah di sini ambil genre idnya (find($genre->id)), biar kita
                        tau si band ini genrenya apa aja trus tampilin ('selected'), kalo ga ada maka null ('').
                    --}}
                    <option {{ $band->genres()->find($genre->id) ? 'selected' : '' }} value="{{ $genre->id }}">
                        {{ $genre->name }}</option>
                    @endforeach
                </select>
                @error('genres')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
