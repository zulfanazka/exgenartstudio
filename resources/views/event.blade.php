<x-layouts.app :title="__('Admin Event')">
    <div class="max-w-6xl mx-auto py-10 relative">

        {{-- Form Upload Event --}}
        <form action="{{ route('admin.manageevent.store') }}" method="POST" enctype="multipart/form-data" class="mb-8">
            @csrf
            <h2 class="text-lg font-semibold mb-3">Tambah Event Baru:</h2>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block font-medium mb-1">Judul Event</label>
                    <input type="text" name="judul" class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="block font-medium mb-1">Upload Gambar Event</label>
                    <label class="cursor-pointer flex items-center border-2 border-dashed border-gray-300 rounded-lg py-2 mb-3 hover:border-teal-400 transition w-full">
                        <span id="fileNameTambah" class="text-gray-500 pl-2">Pilih File</span>
                        <input type="file" name="gambar" id="gambarTambah" class="hidden" accept="image/*" required>
                    </label>
                </div>
            </div>

            <div class="mt-4">
                <label class="block font-medium mb-1">Deskripsi</label>
                <!-- Boleh ditarik ke bawah (hanya vertikal) pada form tambah -->
                <textarea name="deskripsi" rows="1" class="w-full border rounded-lg px-3 py-2 resize-y min-h-[2.7rem]" required></textarea>
            </div>

            <button type="submit" class="bg-teal-500 text-white px-5 py-2 rounded-lg hover:bg-teal-600 transition">
                Simpan Event
            </button>
        </form>

        {{-- Daftar Event --}}
        <section>
            <h2 class="text-xl font-semibold mb-4">📅 Daftar Event</h2>

            <div class="flex overflow-x-auto no-scrollbar space-x-4 py-3">
                @forelse ($events as $event)
                    <div class="relative flex-shrink-0 w-72 bg-white rounded-lg shadow group">
                        <img src="{{ asset('images/event-lomba/' . $event->photo) }}" class="rounded-t-lg w-full h-44 object-cover">
                        <div class="p-3">
                            <h3 class="font-semibold text-gray-800">{{ $event->title }}</h3>
                            <p class="text-gray-600 text-sm line-clamp-3 whitespace-pre-line">{{ $event->description }}</p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                            <button type="button"
                                class="bg-teal-500 text-white px-2 py-1 rounded text-sm"
                                onclick='openEditEvent(
                                    {{ $event->id }},
                                    @json($event->title),
                                    @json($event->description),
                                    @json(asset("images/event-lomba/" . $event->photo))
                                )'>
                                Edit
                            </button>

                            <button type="button"
                                class="bg-red-500 text-white px-2 py-1 rounded text-sm"
                                onclick="openDeleteModal({{ $event->id }})">
                                Hapus
                            </button>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada event.</p>
                @endforelse
            </div>
        </section>
    </div>

    {{-- Modal Edit Event (overlay area adalah elemen #editModal) --}}
    <div id="editModal" class="fixed inset-0 bg-black/20 backdrop-blur-sm hidden items-center justify-center z-50">
        <div id="editModalContent" class="bg-white rounded-lg p-6 w-96 relative">
            <h3 class="text-lg font-semibold mb-4 text-gray-500">Edit Event</h3>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <img id="previewImage" src="" class="w-full h-44 object-cover rounded mb-3 border">

                <label class="block mb-2 text-gray-500">Judul</label>
                <input type="text" name="judul" id="editJudul" class="w-full border rounded px-3 py-2 mb-3 text-black" required>

                <label class="block mb-2 text-gray-500">Deskripsi</label>
                <!-- KEMBALIKAN: edit textarea TIDAK boleh ditarik (resize-none) -->
                <textarea name="deskripsi" id="editDeskripsi" rows="4" class="w-full p-2 border rounded-md resize-none mb-3 text-black" required></textarea>

                <label class="cursor-pointer flex items-center border-2 border-dashed border-gray-300 rounded-lg p-2 hover:border-teal-400 transition mb-3">
                    <span id="fileNameEdit" class="text-gray-500 pl-2">Ganti Gambar</span>
                    <input type="file" name="gambar" id="gambarEdit" class="hidden" accept="image/*">
                </label>

                <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded w-full hover:bg-teal-600">Update</button>
            </form>

            <button onclick="closeEditModal()" class="absolute top-2 right-3 text-gray-500 text-xl">&times;</button>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div id="deleteModal" class="fixed inset-0 bg-black/20 backdrop-blur-sm hidden justify-center items-center z-50">
        <div id="deleteModalContent" class="bg-white rounded-2xl shadow-lg w-[360px] p-6 text-center">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Hapus Event?</h2>
            <p class="text-sm text-gray-600 mb-6">Apakah kamu yakin ingin menghapus event ini? Tindakan ini tidak bisa dibatalkan.</p>
            
            <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeDeleteModal()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">Batal</button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Hapus</button>
            </div>
            </form>
        </div>
    </div>

    <!-- 🔔 Toast Container -->
    <div id="toastContainer" class="fixed top-5 right-5 space-y-3 z-[9999]"></div>

    <script>
        // Tampilkan nama file saat pilih (Tambah)
        document.getElementById('gambarTambah')?.addEventListener('change', function (e) {
            const fileName = e.target.files[0]?.name || 'Pilih File';
            document.getElementById('fileNameTambah').textContent = fileName;
        });

        // Tampilkan nama file saat pilih (Edit) + preview langsung
        document.getElementById('gambarEdit')?.addEventListener('change', function (e) {
            const fileName = e.target.files[0]?.name || 'Ganti Gambar';
            document.getElementById('fileNameEdit').textContent = fileName;

            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('previewImage').src = ev.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Buka modal edit
        function openEditEvent(id, judul, deskripsi, imageUrl) {
            const modal = document.getElementById('editModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('previewImage').src = imageUrl;
            document.getElementById('editJudul').value = judul;
            document.getElementById('editDeskripsi').value = deskripsi;
            document.getElementById('fileNameEdit').textContent = 'Ganti Gambar';
            document.getElementById('editForm').action = `/admin/manage-event/update/${id}`;
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
        }

        // Tutup modal ketika klik di overlay (bukan content)
        document.getElementById('editModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeEditModal();
        });
        // tutup modal edit dengan ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
                closeDeleteModal();
            }
        });

        // Modal Delete (konfirmasi)
        function openDeleteModal(id) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');

            // pastikan route delete sesuai web.php: prefix admin/manage-event -> DELETE /{id}
            form.action = `/admin/manage-event/${id}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }

        // Tutup modal delete ketika klik di overlay
        document.getElementById('deleteModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // === Toast helper (sama behavior seperti gallery) ===
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');

            const colors = {
                success: 'bg-teal-500',
                error: 'bg-red-500',
                warning: 'bg-yellow-500',
                info: 'bg-blue-500'
            };

            toast.className = `${colors[type]} text-white px-4 py-3 rounded-lg shadow-lg flex items-center justify-between w-72 animate-slideIn`;
            toast.innerHTML = `
                <span>${message}</span>
                <button onclick="this.parentElement.remove()" class="ml-3 text-white text-lg leading-none">&times;</button>
            `;

            toastContainer.appendChild(toast);

            // Hapus otomatis setelah 7 detik
            setTimeout(() => toast.remove(), 7000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @elseif(session('error'))
                showToast("{{ session('error') }}", 'error');
            @elseif($errors->any())
                showToast("Terjadi kesalahan validasi. Periksa input Anda.", 'error');
            @endif
        });
    </script>

    <style>
        /* Toast animation (sama seperti gallery) */
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-slideIn {
            animation: slideIn 0.3s ease-out;
        }
    </style>
</x-layouts.app>
