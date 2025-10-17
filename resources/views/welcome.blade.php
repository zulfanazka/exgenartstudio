<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExGen Art Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-white text-gray-800">

    <!-- 🔹 NAVBAR -->
    <nav class="flex justify-center gap-10 py-4 bg-white shadow-sm">
        <a href="#home" class="hover:text-blue-500">Home</a>
        <a href="#event" class="hover:text-blue-500">Event</a>
    </nav>

    <!-- 🔹 HERO SECTION -->
    <section id="home" class="relative text-center py-60">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <!-- Gambar background dummy -->
            <img src="{{ asset('images/bg1.png') }}" alt="background" class="w-full h-full object-cover opacity-80">
        </div>

        <!-- 🔸 LOGO -->
        <div class="flex justify-center">
            <!-- GANTI gambar di bawah dengan logo kamu -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo ExGen" class="h-40 w-auto">
        </div>

        <h1 class="text-3xl md:text-5xl font-bold mb-4">EXGEN ART STUDIO</h1>
        <p class="max-w-xl mx-auto text-sm md:text-base">
            Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
            Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau dan layanan yang
            ramah.
        </p>
    </section>

    <!-- 🔹 PROFILE PENGAJAR -->
    <section class="py-60 bg-white flex flex-col md:flex-row items-center justify-center gap-10 px-6">
        <img src="{{ asset('images/Zulfan.png') }}" alt="Foto Pengajar"
            class="w-72 h-96 object-cover rounded-2xl shadow-xl">
        <div class="max-w-md text-center md:text-left">
            <h2 class="text-3xl font-bold mb-3">Profile Pengajar</h2>
            <p class="text-sm md:text-base">
                Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
                Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau dan layanan
                yang ramah.
            </p>
        </div>
    </section>

    <!-- 🔹 ONLINE & OFFLINE CLASS -->
    <section class="py-40 bg-gradient-to-b from-orange-100 to-orange-200 text-center">
        <div class="flex flex-col md:flex-row justify-center items-center gap-12 px-6">
            <div class="bg-white p-24 rounded-2xl shadow-md w-90">
                <h3 class="text-xl font-bold mb-3">Online Class</h3>
                <p class="text-sm mb-4">
                    Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
                    Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau.
                </p>
                <button class="bg-blue-500 text-white px-5 py-2 rounded-md hover:bg-blue-600">Daftar</button>
            </div>

            <div class="bg-white p-24 rounded-2xl shadow-md w-90">
                <h3 class="text-xl font-bold mb-3">Offline Class</h3>
                <p class="text-sm mb-4">
                    Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
                    Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau.
                </p>
                <button class="bg-blue-500 text-white px-5 py-2 rounded-md hover:bg-blue-600">Daftar</button>
            </div>
        </div>
    </section>

    <!-- 🔹 GALLERY EVENT -->
    <section id="event" class="py-20 bg-teal-900 text-white text-center">
        <h2 class="text-3xl font-bold mb-8">Gallery Event</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6  justify-items-center px-6">
            <div class="w-60 h-60 bg-gray-400 rounded-xl"></div>
            <div class="w-60 h-60 bg-gray-400 rounded-xl"></div>
            <div class="w-60 h-60 bg-gray-400 rounded-xl"></div>
            <div class="w-60 h-60 bg-gray-400 rounded-xl"></div>
        </div>
    </section>

    <!-- 🔹 GALLERY KARYA -->
    <section id="gallery" class="py-24 bg-teal-800 text-white text-center">
        <h2 class="text-3xl font-bold mb-8">Gallery Karya</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6  justify-items-center px-6">
            <div class="w-60 h-60 bg-gray-400 rounded-xl"></div>
            <div class="w-60 h-60 bg-gray-400 rounded-xl"></div>
            <div class="w-60 h-60 bg-gray-400 rounded-xl"></div>
            <div class="w-60 h-60 bg-gray-400 rounded-xl"></div>
        </div>
    </section>

    <!-- 🔹 FOOTER -->
    <footer class="bg-white text-gray-700 py-10 px-6 md:px-20 border-t border-gray-200">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">

            <!-- Kolom Kiri: Logo + Info -->
            <div class="text-center md:text-left">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 mb-4 mx-auto md:mx-0">

                <!-- Tombol Login / Dashboard -->
                <div class="mb-5">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="inline-block px-5 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-100 transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md shadow-md transition">
                                Login
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="inline-block ml-3 bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-md border border-gray-300 transition">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <h3 class="font-semibold text-lg">ExGen Art Studio</h3>
                <p class="text-sm text-gray-500 mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                <div class="mt-3 text-sm">
                    <p>📧 apotek@gmail.com</p>
                    <p>📞 12345678910</p>
                </div>
            </div>

            <!-- Kolom Tengah: Navigasi -->
            <div class="text-center md:text-left">
                <h3 class="font-semibold mb-3 text-lg">Company</h3>
                <ul class="text-sm space-y-2">
                    <li><a href="#profile" class="hover:text-blue-500 transition">Profile</a></li>
                    <li><a href="#product" class="hover:text-blue-500 transition">Product</a></li>
                    <li><a href="#contact" class="hover:text-blue-500 transition">Contact</a></li>
                </ul>
            </div>

            <!-- Kolom Kanan: Sosial Media -->
            <div class="text-center md:text-left">
                <h3 class="font-semibold mb-3 text-lg">Follow Us</h3>
                <div class="flex justify-center md:justify-start gap-4">
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition"><i
                            class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition"><i
                            class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 mt-10 pt-5 text-center text-sm text-gray-500">
            © {{ date('Y') }} ExGen Art Studio. All rights reserved.
        </div>
    </footer>
</body>

</html>
