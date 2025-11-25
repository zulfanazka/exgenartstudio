<x-layouts.app :title="__('Admin Pengajar')">
    <div class="max-w-6xl mx-auto py-10 relative">

        {{-- Form Upload Pengajar --}}
        <form action="{{ route('admin.pengajar.store') }}" method="POST" enctype="multipart/form-data" class="mb-8">
            @csrf
            <h2 class="text-lg font-semibold mb-3">Tambah Pengajar Baru:</h2>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block font-medium mb-1">Nama Pengajar</label>
                    <input type="text" name="nama" class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="block font-medium mb-1">Upload Foto Pengajar</label>

                    <label
                        class="cursor-pointer flex items-center border-2 border-dashed border-gray-300 rounded-lg py-2 mb-3 hover:border-teal-400 transition w-full">
                        <span id="fileNameTambah" class="text-gray-500 pl-2">Pilih File</span>
                        <input type="file" name="foto" id="fotoTambah" class="hidden" accept="image/*" required>
                    </label>
                </div>
            </div>

            <div class="mt-4">
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="1"
                    class="w-full border rounded-lg px-3 py-2 resize-y min-h-[2.7rem]"></textarea>
            </div>

            <button type="submit"
                class="bg-teal-500 text-white px-5 py-2 rounded-lg hover:bg-teal-600 transition">Simpan
                Pengajar</button>
        </form>

        {{-- Daftar Pengajar --}}
        <section>
            <h2 class="text-xl font-semibold mb-4">👨‍🏫 Daftar Pengajar</h2>

            <div class="flex overflow-x-auto no-scrollbar space-x-4 py-3">
                @forelse ($pengajar as $p)
                    <div class="relative flex-shrink-0 w-52 h-full bg-white rounded-lg shadow group">
                        <img src="{{ asset('images/pengajar/' . $p->foto) }}"
                            class="rounded-t-lg w-52 h-72 object-cover">

                        <div class="p-3">
                            <h3 class="font-semibold text-gray-800">{{ $p->nama }}</h3>
                            <p class="text-gray-600 text-sm line-clamp-3 whitespace-pre-line">{{ $p->deskripsi }}</p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div
                            class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition text-sm">
                            <button
                                class="bg-teal-500 text-white px-2 py-1 rounded"
                                onclick='openEditPengajar(
                                    {{ $p->id }},
                                    @json($p->nama),
                                    @json($p->deskripsi),
                                    @json(asset("images/pengajar/" . $p->foto))
                                )'>
                                Edit
                            </button>

                            <button
                                class="bg-red-500 text-white px-2 py-1 rounded"
                                onclick="openDeleteModal({{ $p->id }})">
                                Hapus
                            </button>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada pengajar.</p>
                @endforelse
            </div>
        </section>
    </div>

    {{-- Modal Edit Pengajar --}}
    <div id="editModal"
        class="fixed inset-0 bg-black/20 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 relative">
            <h3 class="text-lg font-semibold mb-4 text-gray-500">Edit Pengajar</h3>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <img id="previewImage" src="" class="w-full h-44 object-cover rounded mb-3 border">

                <label class="block mb-2 text-gray-500">Nama</label>
                <input type="text" name="nama" id="editNama"
                    class="w-full border rounded px-3 py-2 mb-3 text-black" required>

                <label class="block mb-2 text-gray-500">Deskripsi</label>
                <textarea name="deskripsi" id="editDeskripsi" rows="4"
                    class="w-full p-2 border rounded-md resize-none mb-3 text-black"></textarea>

                <label
                    class="cursor-pointer flex items-center border-2 border-dashed border-gray-300 rounded-lg p-2 hover:border-teal-400 transition mb-3">
                    <span id="fileNameEdit" class="text-gray-500 pl-2">Ganti Foto</span>
                    <input type="file" name="foto" id="fotoEdit" class="hidden" accept="image/*">
                </label>

                <button type="submit"
                    class="bg-teal-500 text-white px-4 py-2 rounded w-full hover:bg-teal-600">Update</button>
            </form>

            <button onclick="closeEditModal()"
                class="absolute top-2 right-3 text-gray-500 text-xl">&times;</button>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div id="deleteModal"
        class="fixed inset-0 bg-black/20 backdrop-blur-sm hidden justify-center items-center z-50">
        <div class="bg-white rounded-2xl shadow-lg w-[360px] p-6 text-center">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Hapus Pengajar?</h2>
            <p class="text-sm text-gray-600 mb-6">Aksi ini tidak dapat dikembalikan.</p>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex justify-center gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">Batal</button>

                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Toast --}}
    <div id="toastContainer" class="fixed top-5 right-5 space-y-3 z-[9999]"></div>

    <script>
        // File name (Tambah)
        document.getElementById('fotoTambah')?.addEventListener('change', function(e) {
            document.getElementById('fileNameTambah').textContent = e.target.files[0]?.name || 'Pilih File';
        });

        // File name + preview (Edit)
        document.getElementById('fotoEdit')?.addEventListener('change', function(e) {
            document.getElementById('fileNameEdit').textContent = e.target.files[0]?.name || 'Ganti Foto';

            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    document.getElementById('previewImage').src = ev.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // 🟡 Open Edit
        function openEditPengajar(id, nama, deskripsi, imageUrl) {
            const modal = document.getElementById('editModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('previewImage').src = imageUrl;
            document.getElementById('editNama').value = nama;
            document.getElementById('editDeskripsi').value = deskripsi;
            document.getElementById('fileNameEdit').textContent = "Ganti Foto";

            document.getElementById('editForm').action = `/admin/pengajar/update/${id}`;

        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // 🟥 Open Delete
        function openDeleteModal(id) {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('deleteForm').action = `/admin/pengajar/${id}`;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Toast
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');

            const colors = {
                success: 'bg-teal-500',
                error: 'bg-red-500'
            };

            toast.className =
                `${colors[type]} text-white px-4 py-3 rounded-lg shadow-lg flex items-center justify-between w-72 animate-slideIn`;
            toast.innerHTML = `
                <span>${message}</span>
                <button onclick="this.parentElement.remove()" class="ml-3 text-white text-lg leading-none">&times;</button>
            `;

            container.appendChild(toast);
            setTimeout(() => toast.remove(), 7000);
        }

        // Toast otomatis jika session
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                showToast("{{ session('success') }}", 'success');
            @elseif (session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif
        });
    </script>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slideIn {
            animation: slideIn 0.3s ease-out;
        }
    </style>
</x-layouts.app>
