<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExGen Art Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

</head>

<body class="font-sans bg-white text-gray-800">

    <!-- 🔹 NAVBAR -->
    <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-4 px-6 md:px-10">

            <!-- 🔹 MENU KIRI -->
            <div class="flex items-center gap-8 font-semibold">
                <a href="#home" class="hover:text-blue-500">Home</a>
                <a href="#gallery-event" class="hover:text-blue-500">Gallery</a>
                <a href="/lomba" class="hover:text-blue-500">Event</a>
            </div>

            <!-- 🔹 TOMBOL LOGIN/REGIS -->
            <div class="flex items-center gap-3 font-semibold">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-5 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-100 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-[#1FA7AF] hover:bg-[#177c82] text-white px-4 py-1 rounded-md shadow-md transition">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-1 rounded-md border border-gray-300 transition">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

        </div>
    </nav>

    <!-- 🔹 HERO SECTION -->
    <section id="home" class="relative text-center py-60 overflow-hidden pt-48">
        <!-- 🔹 Background -->
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <img src="{{ asset('images/bg1.png') }}" alt="background" class="w-full h-full object-cover opacity-80">
        </div>

        <!-- 🔹 Gambar Exter di kanan -->
        <img src="{{ asset('images/exter.png') }}" alt="Exter"
            class="hidden lg:block absolute right-0 top-1/2 transform -translate-y-1/2 h-full w-auto">

        <!-- 🔹 Konten utama (logo + teks) -->
        <div class="flex flex-col items-center justify-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo ExGen" class="h-48 w-auto mb-4">
            <h1 class="text-3xl md:text-5xl font-bold mb-4">EXGEN ART STUDIO</h1>
            <p class="max-w-xl mx-auto text-base md:text-lg">
                Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
                Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau dan layanan
                yang ramah.
            </p>
        </div>
    </section>

    <!-- 🔹 PROFILE PENGAJAR -->
    <section id="pengajar" class="py-40 bg-white text-center relative">

        <h2 class="text-3xl font-bold mb-8">Profile Pengajar</h2>

        <!-- Tombol kiri & kanan hanya tampil jika jumlah pengajar lebih dari 1 -->
        @if(isset($pengajar) && count($pengajar) > 1)
            <button id="scrollLeftPengajar"
                class="absolute left-10 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-black/40 text-white rounded-full w-12 h-12 flex items-center justify-center transition">
                ◀
            </button>

            <button id="scrollRightPengajar"
                class="absolute right-10 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-black/40 text-white rounded-full w-12 h-12 flex items-center justify-center transition">
                ▶
            </button>
        @endif

        <!-- Kontainer scroll -->
        <div id="galleryContainerPengajar"
            class="flex overflow-x-auto no-scrollbar space-x-6 px-6 justify-center scroll-smooth snap-x snap-mandatory max-w-[1200px] mx-auto">

            @if(isset($pengajar))
                @foreach ($pengajar as $p)
                    <div class="w-72 h-auto bg-white rounded-2xl shadow-xl flex-shrink-0 snap-start overflow-hidden p-4">  
                        <div class="w-full h-56 overflow-hidden rounded-xl mb-4">
                            <img src="{{ asset('images/pengajar/' . $p->foto) }}" 
                                class="w-full h-full object-cover" 
                                alt="{{ $p->nama }}">
                        </div>

                        <h3 class="text-xl font-bold">{{ $p->nama }}</h3>

                        <p class="text-gray-600 mt-2 text-sm">
                            {{ $p->deskripsi }}
                        </p>
                    </div>
                @endforeach
            @endif
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
                <h3 class="text-3xl font-bold mb-3">Online Class</h3>
                <p class="text-md mb-4">
                    Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
                    Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau.
                </p>

                <div class="flex justify-center">
                    <button class="btn-uiverse">Daftar</button>
                </div>
            </div>

            <div class="bg-white/90 p-16 rounded-2xl shadow-md w-90">
                <h3 class="text-3xl font-bold mb-3">Offline Class</h3>
                <p class="text-md mb-4">
                    Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
                    Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau.
                </p>
                <div class="flex justify-center">
                    <!-- From Uiverse.io by alexroumi -->
                    <button class="btn-uiverse">Daftar</button>
                </div>
            </div>
        </div>
    </section>

    <!-- 🔹 GALLERY EVENT -->
    <section id="gallery-event" class="py-20 bg-white text-black">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center md:items-center gap-16 px-6">

            <!-- Slider -->
            <div class="swiper mySwiper w-[350px] md:w-[400px]">
                <div class="swiper-wrapper">

                    @foreach ($galleryEvent as $file)
                        <div class="swiper-slide">
                            <img src="{{ asset('images/event/' . basename($file)) }}"
                                class="w-full h-[450px] object-cover rounded-xl bg-gray-200" />
                        </div>
                    @endforeach

                </div>

                <!-- Pagination (titik navigasi) -->
                <div class="swiper-pagination mt-4"></div>

            </div>

            <!-- Teks -->
            <div class="w-full md:w-[400px] text-center md:text-center">
                <h2 class="text-3xl font-bold mb-3">Gallery Event</h2>
                <p class="text-gray-700">
                    Kumpulan dokumentasi ini mengabadikan konsentrasi, kreativitas, dan imajinasi para peserta saat
                    mereka
                    menuangkan ide ke atas kanvas. Setiap foto di sini menjadi saksi bisu betapa meriahnya acara,
                    menunjukkan bakat-bakat muda yang berkompetisi dan merayakan seni visual di Exgen Art Studio.
                </p>
            </div>

        </div>
    </section>

    <!-- 🔹 GALLERY KARYA -->
    <section id="gallery-karya" class="py-20 bg-white text-black">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row-reverse items-center md:items-center gap-16 px-6">

            <!-- Slider -->
            <div class="swiper mySwiper w-[350px] md:w-[400px]">
                <div class="swiper-wrapper">

                    @foreach ($galleryKarya as $file)
                        <div class="swiper-slide">
                            <img src="{{ asset('images/karya/' . basename($file)) }}"
                                class="w-full h-[450px] object-cover rounded-xl bg-gray-200" />
                        </div>
                    @endforeach

                </div>

                <!-- Pagination -->
                <div class="swiper-pagination mt-4"></div>

            </div>

            <!-- Teks -->
            <div class="w-full md:w-[400px] text-center md:text-center">
                <h2 class="text-3xl font-bold mb-3">Gallery Karya</h2>
                <p class="text-gray-700">
                    Kumpulan dokumentasi ini mengabadikan konsentrasi, kreativitas, dan imajinasi para peserta saat
                    mereka
                    menuangkan ide ke atas kanvas. Setiap foto di sini menjadi saksi bisu betapa meriahnya acara,
                    menunjukkan bakat-bakat muda yang berkompetisi dan merayakan seni visual di Exgen Art Studio.
                </p>
            </div>

        </div>
    </section>

    <!-- 🔹LOMBA -->
    <section class="relative text-center py-40 overflow-hidden">
        <!-- 🔸 Background seperti bg1 -->
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <img src="{{ asset('images/bg2.png') }}" alt="background" class="w-full h-full object-cover">
        </div>

        <!-- 🔸 Konten -->
        <div class="flex flex-col md:flex-row justify-center items-center gap-12 px-6">
            <div class="bg-white/90 p-16 rounded-2xl shadow-md w-90">
                <h3 class="text-3xl font-bold mb-3">Event ExGen Art Studio</h3>
                <p class="text-md mb-4">
                    Bukan hanya sekedar kelas seni biasa, Exgen Art Studio juga mengadakan berbagai macam event menarik
                    yang bisa kamu ikuti. Cari tahu event yang diselenggarakan oleh Exgen Art Studio disini!
                </p>

                <div class="flex justify-center">
                    <a href="/lomba">
                        <button class="btn-uiverse">Event</button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us -->
    <section class="bg-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-10">
                Hubungi kami
            </h2>

            <div class="flex flex-col lg:flex-row gap-10 items-center">

                <div class="w-full lg:w-3/5 rounded-lg shadow-xl overflow-hidden aspect-video">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31690.686493714667!2d107.50004887649169!3d-6.850288930619117!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e477892906ef%3A0x9e74cf1bf52a6148!2sCipageran%2C%20Cimahi%20Utara%2C%20Cimahi%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1763603990275!5m2!1sen!2sid"
                        class="w-full h-full"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="w-full lg:w-2/5 p-6 space-y-6">

                    <div class="text-xl">
                        <p class="font-bold text-gray-700 mb-1">Alamat :</p>
                        <p class="text-gray-900">Jl. Encep Kartawirya No.36 RT.02/RW.03, Cimahi Utara, Jawa Barat</p>
                    </div>

                    <div class="text-xl">
                        <p class="font-bold text-gray-700 mb-1">Alamat :</p>

                        <div class="flex items-center space-x-3 mb-2">
                            <span class="text-pink-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </span>
                            <a href="https://www.instagram.com/exgen.artstudio_" target="_blank"
                                class="text-gray-900 hover:text-pink-600 transition duration-150">
                                @exgen.artstudio_
                            </a>
                        </div>

                        <div class="flex items-center space-x-3">
                            <span class="text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C7.82 21 3 16.18 3 10V5z">
                                    </path>
                                </svg>
                            </span>
                            <a href="tel:+62897-9171-808"
                                class="text-gray-900 hover:text-green-600 transition duration-150">
                                +62897-9171-808
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <a href="https://wa.me/6287771559901" target="_blank" class="fixed bottom-6 right-6 z-50">
                <button class="btn-wa">
                    <div class="sign-wa">
                        <svg class="socialSvg whatsappSvg" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 
                                1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 
                                7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 
                                1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 
                                2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 
                                3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099
                                -.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525
                                -.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198
                                .198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34
                                -.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 
                                0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 
                                1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
                            </path>
                        </svg>
                    </div>
                    <div class="text-wa">WhatsApp</div>
                </button>
            </a>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white text-gray-700 py-10 px-6 md:px-20 border-t border-gray-200">

        <!-- Bagian Atas -->
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-10 text-center md:text-left">
            
            <!-- Logo -->
            <div class="flex-shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-24 mx-auto md:mx-0">
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

            <!-- Navigasi -->
            <div>
                <h3 class="font-semibold mb-2 text-lg">Company</h3>
                <ul class="text-sm space-y-1 text-gray-500">
                    <li><a href="#profile" class="hover:text-blue-500 transition">Profile</a></li>
                    <li><a href="#product" class="hover:text-blue-500 transition">Product</a></li>
                    <li><a href="#contact" class="hover:text-blue-500 transition">Contact</a></li>
                </ul>
            </div>

        </div>

        <!-- ✔ Copyright dipindah keluar -->
        <div class="border-t border-gray-200 mt-8 pt-4 text-center text-sm text-gray-500">
            © {{ date('Y') }} ExGen Art Studio. All rights reserved.
        </div>

    </footer>


    <script>
        const swiper = new Swiper('.mySwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,

            grabCursor: true,
            keyboard: true,

            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>

    <script>
        // scroll pengajar
        const pengajarContainer = document.getElementById('galleryContainerPengajar');
        const leftBtn = document.getElementById('scrollLeftPengajar');
        const rightBtn = document.getElementById('scrollRightPengajar');

        if (leftBtn && rightBtn) {
            leftBtn.addEventListener('click', () => {
                pengajarContainer.scrollBy({ left: -300, behavior: 'smooth' });
            });

            rightBtn.addEventListener('click', () => {
                pengajarContainer.scrollBy({ left: 300, behavior: 'smooth' });
            });
        }
    </script>


</body>

</html>