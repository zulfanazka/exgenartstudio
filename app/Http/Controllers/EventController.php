<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // 🧭 Tampilkan halaman admin event (tetap pakai view admin)
    public function index()
    {
        $events = Event::latest()->get();
        return view('event', compact('events'));
    }

    // ➕ Tambah event baru (admin)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image',
        ]);

        $imageName = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('images/event-lomba'), $imageName);

        Event::create([
            'title' => $request->judul,
            'description' => $request->deskripsi,
            'photo' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Event berhasil ditambahkan!');
    }

    // ✏️ Update event (admin)
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $event->title = $request->judul;
        $event->description = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/event-lomba'), $imageName);
            // hapus file lama jika ada
            if ($event->photo && file_exists(public_path('images/event-lomba/' . $event->photo))) {
                unlink(public_path('images/event-lomba/' . $event->photo));
            }
            $event->photo = $imageName;
        }

        $event->save();

        return redirect()->back()->with('success', 'Event berhasil diperbarui!');
    }

    // ❌ Hapus event (admin)
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->photo && file_exists(public_path('images/event-lomba/' . $event->photo))) {
            unlink(public_path('images/event-lomba/' . $event->photo));
        }

        $event->delete();

        return back()->with('success', 'Event berhasil dihapus.');
    }

    // 🟢 PUBLIC - Tampilkan semua event ke halaman user (/lomba)
    public function publicIndex()
    {
        // Ambil semua event terbaru duluan
        $events = Event::latest()->get();

        // Kirim ke view lomba (yang sekarang berada di resources/views/lomba.blade.php)
        return view('lomba', compact('events'));
    }
}
