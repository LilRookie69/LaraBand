<div class="list-group mb-5">
    <a href="/dashboard"
        class="list-group-item list-group-item-action {{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a>
</div>

<div class="my-4">
    <small class="text-secondary d-block mb-2">Band</small>
    <div class="list-group">
        <a href="{{ route('bands.create') }}"
            class="list-group-item list-group-item-action {{ Request::routeIs('bands.create') ? 'active' : '' }}">Create</a>
        <a href="#" class="list-group-item list-group-item-action">Table</a>
    </div>
</div>

<div class="mb-4">
    <small class="text-secondary d-block mb-2">Album</small>
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action">Create</a>
        <a href="#" class="list-group-item list-group-item-action">Table</a>
    </div>
</div>

<div class="mb-4">
    <small class="text-secondary d-block mb-2">Genre</small>
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action">Create</a>
        <a href="#" class="list-group-item list-group-item-action">Table</a>
    </div>
</div>
