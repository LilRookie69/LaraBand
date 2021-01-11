<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Models\Band;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BandController extends Controller
{

    public function create()
    {
        return view('bands.create', [
            'genres' => Genre::get(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'thumbnail' => request('thumbnail') ? 'image|mimes:jpeg,png' : '',
            //name unique di table bands,column name
            'name' => 'required|unique:bands,name',
            'genres' => 'required|array'
        ]);

        $band = Band::create([
            //buat imagenya di ganti di .env jadi ke folder public jadi di store di /storage/app/public
            'thumbnail' => request('thumbnail') ? request()->file('thumbnail')->store('images/band') : null,
            'name' => request('name'),
            'slug' => Str::slug(request('name'))
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band was Created');
    }

    public function table()
    {
        return view('bands.table', [
            'bands' => Band::orderBy('id', 'ASC')->paginate(5),
        ]);
    }

    // band memiliki relasi ke genre, lihat di model, jadi keduanya saling terhubung
    public function edit(Band $band)
    {
        return view('bands.edit', [
            'band' => $band,
            'genres' => Genre::get()
        ]);
    }

    public function update(Band $band)
    {
        request()->validate([
            'thumbnail' => request('thumbnail') ? 'image|mimes:jpeg,png' : '',
            // name unique di table bands,column name
            // pada update di beri notation, untuk memperkenalkan bahwa itu idnya, jadi bila ada yang sama tidak error.
            'name' => 'required|unique:bands,name,' . $band->id,
            'genres' => 'required|array'
        ]);

        //jika dari requeust (data baru dari entry field), memiliki tumbnail.
        if (request('thumbnail')) {
            //maka hapus thumbnail lama
            Storage::delete($band->thumbnail);
            // lalu variable thumbnail akan berisi file baru dari request.
            $thumbnail = request()->file('thumbnail')->store('images/band');
        }
        // jika band memiliki thumbnail dan otomatis karena ini kondisi kedua setelah if request('thumbnail')
        // maka di kondisi ini tentunya tidak ada request (data baru dari entry field).
        elseif ($band->thumbnail) {
            // maka variable thumbnail berisi thumbnail lama.
            $thumbnail = $band->thumbnail;
        }
        // jika band tidak memiliki thumbnail lama, dan tidak juga ada request (selain kedua kondisi diatas).
        else {
            // maka isi variable thumbnail dengan null.
            $thumbnail = null;
        }

        $band->update([
            'thumbnail' => $thumbnail,
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band was Updated');
    }

    public function destroy(Band $band)
    {
        Storage::delete($band->thumbnail);
        $band->genres()->detach();
        $band->delete();
    }
}