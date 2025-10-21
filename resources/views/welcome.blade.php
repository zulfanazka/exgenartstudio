<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExGen Art Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>

</head>

<body class="font-sans bg-white text-gray-800">

    <!-- 🔹 NAVBAR -->
    <nav class="fixed top-0 left-0 w-full flex justify-start gap-10 py-4 px-36 bg-white shadow-md font-semibold z-50">
        <a href="#home" class="hover:text-blue-500">Home</a>
        <a href="#gallery-event" class="hover:text-blue-500">Gallery</a>
        <a href="/lomba" class="hover:text-blue-500">Event</a>
    </nav>

    <!-- 🔹 HERO SECTION -->
    <section id="home" class="relative text-center py-60 overflow-hidden pt-48">
        <!-- 🔹 Background -->
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <img src="{{ asset('images/bg1.png') }}" alt="background" class="w-full h-full object-cover opacity-80">
        </div>

        <!-- 🔹 Gambar Exter di kanan -->
        <img src="{{ asset('images/exter.png') }}" 
            alt="Exter" 
            class="absolute right-0 top-1/2 transform -translate-y-1/2 h-full w-auto">

        <!-- 🔹 Konten utama (logo + teks) -->
        <div class="flex flex-col items-center justify-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo ExGen" class="h-40 w-auto mb-4">
            <h1 class="text-3xl md:text-5xl font-bold mb-4">EXGEN ART STUDIO</h1>
            <p class="max-w-xl mx-auto text-sm md:text-base">
                Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
                Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau dan layanan yang ramah.
            </p>
        </div>
    </section>

    <!-- 🔹 PROFILE PENGAJAR -->
    <section class="py-60 bg-white flex flex-col md:flex-row items-center justify-center gap-10 px-6">
        <img src="{{ asset('images/Zulfan.png') }}" alt="Foto Pengajar"
            class="w-72 h-96 object-cover rounded-2xl shadow-xl">
        <div class="max-w-md text-center md:text-left">
            <h2 class="text-3xl font-bold mb-3">Profile Pengajar</h2>
            <p class="text-md md:text-base">
                Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
                Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau dan layanan
                yang ramah.
            </p>
        </div>
    </section>

    <!-- 🔹 ONLINE & OFFLINE CLASS -->
    <section class="relative text-center py-40 overflow-hidden">
        <!-- 🔸 Background seperti bg1 -->
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <img src="{{ asset('images/bg2.png') }}" alt="background" class="w-full h-full object-cover">
        </div>

        <!-- 🔸 Konten -->
        <div class="flex flex-col md:flex-row justify-center items-center gap-12 px-6">
            <div class="bg-white/90 p-16 rounded-2xl shadow-md w-90">
                <h3 class="text-xl font-bold mb-3">Online Class</h3>
                <p class="text-md mb-4">
                    Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
                    Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau.
                </p>
                <button class="bg-blue-500 text-white px-5 py-2 rounded-md hover:bg-blue-600 font-semibold">Daftar</button>
            </div>

            <div class="bg-white/90 p-16 rounded-2xl shadow-md w-90">
                <h3 class="text-xl font-bold mb-3">Offline Class</h3>
                <p class="text-md mb-4">
                    Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
                    Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau.
                </p>
                <button class="bg-blue-500 text-white px-5 py-2 rounded-md hover:bg-blue-600 font-semibold">Daftar</button>
            </div>
        </div>
    </section>

    <!-- 🔹 GALLERY EVENT -->
    <section id="gallery-event" class="py-20 bg-teal-900 text-white text-center relative">
        <h2 class="text-3xl font-bold mb-8">Gallery Event</h2>

        <!-- Tombol kiri -->
        <button id="scrollLeftEvent"
            class="absolute left-10 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white rounded-full w-12 h-12 flex items-center justify-center backdrop-blur-md transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </button>

        <!-- Tombol kanan -->
        <button id="scrollRightEvent"
            class="absolute right-10 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white rounded-full w-12 h-12 flex items-center justify-center backdrop-blur-md transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>

        <!-- Kontainer scroll -->
        <div id="galleryContainerEvent"
            class="flex overflow-x-auto no-scrollbar space-x-6 px-6 justify-start scroll-smooth snap-x snap-mandatory max-w-[1200px] mx-auto">

            @foreach ($galleryEvent as $file)
                <div class="w-80 h-80 bg-white rounded-xl flex-shrink-0 snap-start overflow-hidden">
                    <img src="{{ asset('images/event/' . basename($file)) }}" class="w-full h-full object-cover" alt="">
                </div>
            @endforeach
        </div>
    </section>

    <!-- 🔹 GALLERY KARYA -->
    <section id="gallery-karya" class="py-20 bg-teal-800 text-white text-center relative">
        <h2 class="text-3xl font-bold mb-8">Gallery Karya</h2>

        <!-- Tombol kiri -->
        <button id="scrollLeftKarya"
            class="absolute left-10 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white rounded-full w-12 h-12 flex items-center justify-center backdrop-blur-md transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </button>

        <!-- Tombol kanan -->
        <button id="scrollRightKarya"
            class="absolute right-10 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white rounded-full w-12 h-12 flex items-center justify-center backdrop-blur-md transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>

        <!-- Kontainer scroll -->
        <div id="galleryContainerKarya"
            class="flex overflow-x-auto no-scrollbar space-x-6 px-6 justify-start scroll-smooth snap-x snap-mandatory max-w-[1200px] mx-auto">

            @foreach ($galleryKarya as $file)
                <div class="w-80 h-80 bg-white rounded-xl flex-shrink-0 snap-start overflow-hidden">
                    <img src="{{ asset('images/karya/' . basename($file)) }}" class="w-full h-full object-cover" alt="">
                </div>
            @endforeach
        </div>
    </section>

    <!-- 🔹 FOOTER -->
    <footer class="bg-white text-gray-700 py-10 px-6 md:px-20 border-t border-gray-200">
        <!-- Bagian Atas: Logo + Info + Company -->
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-10 text-center md:text-left">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 mx-auto md:mx-0">
            </div>

            <!-- Info Perusahaan -->
            <div>
                <h3 class="font-semibold text-lg">ExGen Art Studio</h3>
                <p class="text-sm text-gray-500 mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                <div class="mt-3 text-sm">
                    <p class="flex items-center justify-center md:justify-start gap-2 text-gray-500">
                        <span>📧</span> <span>E-mail: apotek@gmail.com</span>
                    </p>
                    <p class="flex items-center justify-center md:justify-start gap-2 text-gray-500">
                        <span>📞</span> <span>Phone: 12345678910</span>
                    </p>
                </div>
            </div>

            <!-- Navigasi Company -->
            <div>
                <h3 class="font-semibold mb-2 text-lg">Company</h3>
                <ul class="text-sm space-y-1 text-gray-500">
                    <li><a href="#profile" class="hover:text-blue-500 transition">Profile</a></li>
                    <li><a href="#product" class="hover:text-blue-500 transition">Product</a></li>
                    <li><a href="#contact" class="hover:text-blue-500 transition">Contact</a></li>
                </ul>
            </div>
        </div>

        <!-- Garis & Copyright -->
        <div class="border-t border-gray-200 mt-8 pt-4 text-center text-sm text-gray-500">
            © {{ date('Y') }} ExGen Art Studio. All rights reserved.
        </div>
    </footer>

    <script>
        // Gallery Event
        const galleryEvent = document.getElementById('galleryContainerEvent');
        document.getElementById('scrollLeftEvent').addEventListener('click', () => {
            galleryEvent.scrollBy({ left: -300, behavior: 'smooth' });
        });
        document.getElementById('scrollRightEvent').addEventListener('click', () => {
            galleryEvent.scrollBy({ left: 300, behavior: 'smooth' });
        });

        // Gallery Karya
        const galleryKarya = document.getElementById('galleryContainerKarya');
        document.getElementById('scrollLeftKarya').addEventListener('click', () => {
            galleryKarya.scrollBy({ left: -300, behavior: 'smooth' });
        });
        document.getElementById('scrollRightKarya').addEventListener('click', () => {
            galleryKarya.scrollBy({ left: 300, behavior: 'smooth' });
        });
    </script>

</body>

</html>
