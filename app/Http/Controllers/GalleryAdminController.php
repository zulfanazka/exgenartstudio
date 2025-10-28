<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GalleryAdminController extends Controller
{
    public function index()
    {
        // Ambil semua data event & karya dari database
        $galleryEvent = DB::table('gallery_events')->get();
        $galleryKarya = DB::table('gallery_karyas')->get();

        return view('dashboard', compact('galleryEvent', 'galleryKarya'));
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $namaFile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/event'), $namaFile);

                DB::table('gallery_events')->insert([
                    'nama_file' => $namaFile,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return back()->with('success', 'Foto event berhasil diupload!');
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $namaFile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/karya'), $namaFile);

                DB::table('gallery_karyas')->insert([
                    'nama_file' => $namaFile,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return back()->with('success', 'Foto karya berhasil diupload!');
    }

    public function deleteEvent($id)
    {
        $event = DB::table('gallery_events')->where('id', $id)->first();

        if ($event) {
            $path = public_path('images/event/' . $event->nama_file);
            if (file_exists($path)) {
                unlink($path);
            }

            DB::table('gallery_events')->where('id', $id)->delete();
        }

        return back()->with('success', 'Foto event berhasil dihapus!');
    }

    public function deleteGallery($id)
    {
        $karya = DB::table('gallery_karyas')->where('id', $id)->first();

        if ($karya) {
            $path = public_path('images/karya/' . $karya->nama_file);
            if (file_exists($path)) {
                unlink($path);
            }

            DB::table('gallery_karyas')->where('id', $id)->delete();
        }

        return back()->with('success', 'Foto karya berhasil dihapus!');
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $event = DB::table('gallery_events')->where('id', $id)->first();

        if ($event) {
            // Hapus file lama
            $oldPath = public_path('images/event/' . $event->nama_file);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Upload file baru
            $file = $request->file('image');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/event'), $namaFile);

            // Update ke database
            DB::table('gallery_events')->where('id', $id)->update([
                'nama_file' => $namaFile,
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Foto event berhasil diperbarui!');
    }

    public function updateGallery(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $karya = DB::table('gallery_karyas')->where('id', $id)->first();

        if ($karya) {
            // Hapus file lama
            $oldPath = public_path('images/karya/' . $karya->nama_file);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Upload file baru
            $file = $request->file('image');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/karya'), $namaFile);

            // Update ke database
            DB::table('gallery_karyas')->where('id', $id)->update([
                'nama_file' => $namaFile,
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Foto karya berhasil diperbarui!');
    }
}