<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => __('Galeri Admin')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Galeri Admin'))]); ?>

    <div class="max-w-6xl mx-auto py-10">

        
        <form action="<?php echo e(route('event.store')); ?>" method="POST" enctype="multipart/form-data" class="mb-6">
            <?php echo csrf_field(); ?>
            <label class="block mb-2 text-lg font-semibold">Upload Foto Kelas:</label>

            
            <label class="cursor-pointer flex items-center border-2 border-dashed border-gray-300 rounded-lg p-3 mb-3 hover:border-teal-400 transition w-2/3 sm:w-1/2">
                <span class="text-gray-500 pl-2">Pilih File</span>
                <input type="file" name="images[]" multiple class="hidden" accept="image/*" required>
            </label>

            <button type="submit" class="bg-[#1FA7AF] text-white px-4 py-2 rounded-lg hover:bg-teal-600 transition">
                Upload Foto
            </button>
        </form>

        
        <section>
            <h2 class="text-xl font-semibold mb-3">📷 Galeri Kelas</h2>

            <div class="flex overflow-x-auto no-scrollbar space-x-4 py-3">
                <?php $__empty_1 = true; $__currentLoopData = $galleryEvent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="relative flex-shrink-0 w-64 h-48 group">
                        <img src="<?php echo e(asset('images/event/' . $img->nama_file)); ?>" class="rounded-lg shadow w-full h-full object-cover">

                        
                        <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                            
                            <button type="button" 
                                class="bg-teal-500 text-white px-2 py-1 rounded text-sm"
                                onclick="openEditModal('event', <?php echo e($img->id); ?>, '<?php echo e(asset('images/event/' . $img->nama_file)); ?>')">
                                Edit
                            </button>

                            
                            <button type="button" 
                                class="bg-red-500 text-white px-2 py-1 rounded text-sm"
                                onclick="openDeleteModal('event', <?php echo e($img->id); ?>)">
                                Hapus
                            </button>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p>Tidak ada foto kelas.</p>
                <?php endif; ?>
            </div>
        </section>

        <hr class="my-8">

        
        <form action="<?php echo e(route('gallery.store')); ?>" method="POST" enctype="multipart/form-data" class="mb-6">
            <?php echo csrf_field(); ?>
            <label class="block mb-2 text-lg font-semibold">Upload Foto Karya:</label>

            
            <label class="cursor-pointer flex items-center border-2 border-dashed border-gray-300 rounded-lg p-3 mb-3 hover:border-teal-400 transition w-2/3 sm:w-1/2">
                <span class="text-gray-500 pl-2">Pilih File</span>
                <input type="file" name="images[]" multiple class="hidden" accept="image/*" required>
            </label>

            <button type="submit" class="bg-[#1FA7AF] text-white px-4 py-2 rounded-lg hover:bg-teal-600 transition">
                Upload Foto
            </button>
        </form>

        
        <section>
            <h2 class="text-xl font-semibold mb-3">🎨 Galeri Karya</h2>

            <div class="flex overflow-x-auto no-scrollbar space-x-4 py-3">
                <?php $__empty_1 = true; $__currentLoopData = $galleryKarya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="relative flex-shrink-0 w-64 h-48 group">
                        <img src="<?php echo e(asset('images/karya/' . $img->nama_file)); ?>" class="rounded-lg shadow w-full h-full object-cover">

                        
                        <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                            
                            <button type="button" 
                                class="bg-teal-500 text-white px-2 py-1 rounded text-sm"
                                onclick="openEditModal('karya', <?php echo e($img->id); ?>, '<?php echo e(asset('images/karya/' . $img->nama_file)); ?>')">
                                Edit
                            </button>

                            
                            <button type="button" 
                                class="bg-red-500 text-white px-2 py-1 rounded text-sm"
                                onclick="openDeleteModal('gallery', <?php echo e($img->id); ?>)">
                                Hapus
                            </button>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p>Tidak ada foto karya.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>

    
    <div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-96 relative">
            <h3 class="text-lg font-semibold mb-4">Edit Foto</h3>
            
            
            <img id="editPreview" src="" class="w-full h-48 object-cover rounded mb-4 border">

            
            <form id="editForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
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
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
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
            <?php if(session('success')): ?>
                showToast("<?php echo e(session('success')); ?>", 'success');
            <?php elseif(session('error')): ?>
                showToast("<?php echo e(session('error')); ?>", 'error');
            <?php elseif($errors->any()): ?>
                showToast("Terjadi kesalahan validasi. Periksa input Anda.", 'error');
            <?php endif; ?>
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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH D:\PROJEK MANPROTI\exgenartstudio-main\resources\views/dashboard.blade.php ENDPATH**/ ?>