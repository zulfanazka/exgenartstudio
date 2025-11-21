<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajar;

class PengajarController extends Controller
{
    public function index()
    {
        $pengajar = Pengajar::all();
        return view('pengajar', compact('pengajar'));

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

        $filename = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('images/pengajar'), $filename);

        Pengajar::create([
            'nama' => $request->nama,
            'foto' => $filename,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.pengajar.index')
                         ->with('success', 'Pengajar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pengajar = Pengajar::findOrFail($id);
        return view('admin.pengajar.edit', compact('pengajar'));
    }

    public function update(Request $request, $id)
    {
        $pengajar = Pengajar::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'foto' => 'nullable|image',
            'deskripsi' => 'nullable',
        ]);

        // Jika upload foto baru
        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/pengajar'), $filename);

            // Hapus foto lama
            if (file_exists(public_path('images/pengajar/' . $pengajar->foto))) {
                unlink(public_path('images/pengajar/' . $pengajar->foto));
            }

            $pengajar->foto = $filename;
        }

        $pengajar->nama = $request->nama;
        $pengajar->deskripsi = $request->deskripsi;
        $pengajar->save();

        return redirect()->route('admin.pengajar.index')
                         ->with('success', 'Pengajar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengajar = Pengajar::findOrFail($id);

        if (file_exists(public_path('images/pengajar/' . $pengajar->foto))) {
            unlink(public_path('images/pengajar/' . $pengajar->foto));
        }

        $pengajar->delete();

        return redirect()->route('admin.pengajar.index')
                         ->with('success', 'Pengajar berhasil dihapus!');
    }
}
