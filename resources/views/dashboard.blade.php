<x-layouts.app :title="__('Galeri Admin')">

    <div class="max-w-6xl mx-auto py-10">

        {{-- Upload Event --}}
        <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data" class="mb-6">
            @csrf
            <label class="block mb-2 text-lg font-semibold">Upload Foto Event:</label>

            {{-- Input File Custom --}}
            <label class="cursor-pointer flex items-center border-2 border-dashed border-gray-300 rounded-lg p-3 mb-3 hover:border-teal-400 transition w-2/3 sm:w-1/2">
                <span class="text-gray-500 pl-2">Pilih File</span>
                <input type="file" name="images[]" multiple class="hidden" accept="image/*" required>
            </label>

            <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded-lg hover:bg-teal-600 transition">
                Upload Event
            </button>
        </form>

        {{-- Gallery Event --}}
        <section>
            <h2 class="text-xl font-semibold mb-3">📷 Galeri Event</h2>

            <div class="flex overflow-x-auto no-scrollbar space-x-4 py-3">
                @forelse ($galleryEvent as $img)
                    <div class="relative flex-shrink-0 w-64 h-48 group">
                        <img src="{{ asset('images/event/' . $img->nama_file) }}" class="rounded-lg shadow w-full h-full object-cover">

                        {{-- Tombol Aksi --}}
                        <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                            {{-- Tombol Edit --}}
                            <button type="button" 
                                class="bg-teal-500 text-white px-2 py-1 rounded text-sm"
                                onclick="openEditModal('event', {{ $img->id }}, '{{ asset('images/event/' . $img->nama_file) }}')">
                                Edit
                            </button>

                            {{-- Tombol Hapus (pakai modal konfirmasi) --}}
                            <button type="button" 
                                class="bg-red-500 text-white px-2 py-1 rounded text-sm"
                                onclick="openDeleteModal('event', {{ $img->id }})">
                                Hapus
                            </button>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada foto event.</p>
                @endforelse
            </div>
        </section>

        <hr class="my-8">

        {{-- Upload Karya --}}
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="mb-6">
            @csrf
            <label class="block mb-2 text-lg font-semibold">Upload Foto Karya:</label>

            {{-- Input File Custom --}}
            <label class="cursor-pointer flex items-center border-2 border-dashed border-gray-300 rounded-lg p-3 mb-3 hover:border-teal-400 transition w-2/3 sm:w-1/2">
                <span class="text-gray-500 pl-2">Pilih File</span>
                <input type="file" name="images[]" multiple class="hidden" accept="image/*" required>
            </label>

            <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded-lg hover:bg-teal-600 transition">
                Upload Karya
            </button>
        </form>

        {{-- Gallery Karya --}}
        <section>
            <h2 class="text-xl font-semibold mb-3">🎨 Galeri Karya</h2>

            <div class="flex overflow-x-auto no-scrollbar space-x-4 py-3">
                @forelse ($galleryKarya as $img)
                    <div class="relative flex-shrink-0 w-64 h-48 group">
                        <img src="{{ asset('images/karya/' . $img->nama_file) }}" class="rounded-lg shadow w-full h-full object-cover">

                        {{-- Tombol Aksi --}}
                        <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                            {{-- Tombol Edit --}}
                            <button type="button" 
                                class="bg-teal-500 text-white px-2 py-1 rounded text-sm"
                                onclick="openEditModal('karya', {{ $img->id }}, '{{ asset('images/karya/' . $img->nama_file) }}')">
                                Edit
                            </button>

                            {{-- Tombol Hapus (pakai modal konfirmasi) --}}
                            <button type="button" 
                                class="bg-red-500 text-white px-2 py-1 rounded text-sm"
                                onclick="openDeleteModal('gallery', {{ $img->id }})">
                                Hapus
                            </button>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada foto karya.</p>
                @endforelse
            </div>
        </section>
    </div>

    {{-- 🔹 Modal Edit Foto --}}
    <div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-96 relative">
            <h3 class="text-lg font-semibold mb-4">Edit Foto</h3>
            
            {{-- Preview Foto --}}
            <img id="editPreview" src="" class="w-full h-48 object-cover rounded mb-4 border">

            {{-- Form Update --}}
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Input File Custom --}}
                <label for="imageInput" 
                    class="cursor-pointer flex items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-lg p-3 mb-3 hover:border-teal-400 transition">
                    <span id="fileLabel" class="text-gray-500">Pilih File</span>
                    <input type="file" id="imageInput" name="image" class="hidden" accept="image/*" required>
                </label>

                <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded w-full hover:bg-teal-600 transition">
                    Update
                </button>
            </form>

            <button onclick="closeEditModal()" class="absolute top-2 right-3 text-gray-500 text-xl">&times;</button>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black/20 backdrop-blur-sm hidden justify-center items-center z-50">
        <div class="bg-white rounded-2xl shadow-lg w-[360px] p-6 text-center">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Hapus Foto?</h2>
            <p class="text-sm text-gray-600 mb-6">Apakah kamu yakin ingin menghapus foto ini? Tindakan ini tidak bisa dibatalkan.</p>
            
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
        //Tulisan file muncul di dalam kotak upload karya dan event
        document.querySelectorAll('input[type="file"]').forEach((input) => {
            input.addEventListener('change', (e) => {
                const label = e.target.previousElementSibling;
                const fileCount = e.target.files.length;

                if (fileCount === 0) {
                    label.textContent = 'Pilih File';
                } else if (fileCount === 1) {
                    label.textContent = e.target.files[0].name;
                } else {
                    label.textContent = `${fileCount} files selected`;
                }
            });
        });

        // === Modal Edit ===
        function openEditModal(type, id, imageUrl) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const preview = document.getElementById('editPreview');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            preview.src = imageUrl;

            if (type === 'event') {
                form.action = `/admin/event/update/${id}`;
            } else {
                form.action = `/admin/gallery/update/${id}`;
            }
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Tutup modal edit jika klik di luar konten modal
        document.getElementById('editModal')?.addEventListener('click', function (e) {
            if (e.target === this) closeEditModal();
        });

        // === Modal Hapus ===
        function openDeleteModal(type, id) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');

            if (type === 'event') {
                form.action = `/admin/event/${id}`;
            } else {
                form.action = `/admin/gallery/${id}`;
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Tutup modal hapus jika klik di luar konten modal
        document.getElementById('deleteModal')?.addEventListener('click', function (e) {
            if (e.target === this) closeDeleteModal();
        });

        // Tutup modal dengan tombol ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeEditModal();
                closeDeleteModal();
            }
        });

        // Preview gambar baru + tampilkan nama file
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('imageInput');
            const fileLabel = document.getElementById('fileLabel');
            const preview = document.getElementById('editPreview');

            if (input) {
                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    const fileName = file ? file.name : 'Pilih File';
                    fileLabel.textContent = fileName;

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (ev) {
                            preview.src = ev.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // === Toast Handling ===
            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @elseif(session('error'))
                showToast("{{ session('error') }}", 'error');
            @elseif($errors->any())
                showToast("Terjadi kesalahan validasi. Periksa input Anda.", 'error');
            @endif
        });

        // === Toast ===
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
            setTimeout(() => toast.remove(), 7000);
        }
    </script>

    <style>
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-slideIn {
            animation: slideIn 0.3s ease-out;
        }
    </style>

</x-layouts.app>
