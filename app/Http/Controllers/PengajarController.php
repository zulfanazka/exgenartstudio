<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengajar;

class PengajarController extends Controller
{
    //
    public function index()
    {
        $pengajar = Pengajar::all();
        return view('admin.pengajar.index', compact('pengajar'));
    }

    public function create()
    {
        return view('admin.pengajar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'foto' => 'required|image',
            'deskripsi' => 'nullable',
        ]);

        // Simpan foto ke public/images/pengajar
        $filename = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('images/pengajar'), $filename);

        Pengajar::create([
            'nama' => $request->nama,
            'foto' => $filename,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.pengajar.index')->with('success', 'Pengajar berhasil ditambahkan!');
    }
}
