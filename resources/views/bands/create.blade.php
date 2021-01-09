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
    <div class="card-header">New Band</div>
    <div class="card-body">
        <form action="{{ route('bands.create') }}" method="post" enctype="multipart/form-data">
            @csrf
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
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="genres">Choose Genre</label>
                <select name="genres[]" id="genres"
                    class="form-control select2multiple @error('genres') is-invalid @enderror" multiple>
                    @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
                @error('genres')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection

