<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Lomba | ExGen Art Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-white text-gray-800">

    <!-- 🔹 NAVBAR -->
    <nav class="fixed top-0 left-0 w-full flex justify-start gap-10 py-4 px-36 bg-white shadow-md font-semibold z-50">
        <a href="/" class="hover:text-blue-500">Home</a>
        <a href="/#gallery-event" class="hover:text-blue-500">Gallery</a>
        <a href="#event" class="hover:text-blue-500">Event</a>
    </nav>

    <!-- 🔹 SECTION LOMBA -->
    <section id="lomba"
        class="min-h-screen flex flex-col md:flex-row items-center justify-center gap-12 px-8 md:px-24 pt-32 pb-20 bg-white">
        @if(isset($events) && $events->count())
            <div class="flex flex-col items-center justify-center w-full px-8 md:px-24 pt-32 pb-20 space-y-24">
                @foreach($events as $event)
                    <div class="flex flex-col md:flex-row items-center justify-center gap-12 w-full">
                        <div class="flex-shrink-0">
                            <div class="w-80 h-96 bg-gray-300 rounded-2xl shadow-inner">
                                <img src="{{ asset('images/event-lomba/' . $event->photo) }}" 
                                    alt="Poster Lomba" 
                                    class="w-80 h-96 object-cover rounded-2xl shadow-xl">
                            </div>
                        </div>

                        <div class="max-w-md text-center md:text-left">
                            <h2 class="text-4xl font-extrabold mb-4">{{ strtoupper($event->title) }}</h2>
                            <p class="text-gray-600 mb-6 leading-relaxed whitespace-pre-line">
                                {{ $event->description }}
                            </p>

                            <a href="#daftar"
                                class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition">
                                Daftar
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center text-lg">Belum ada event yang tersedia.</p>
        @endif
    </section>

    <!-- 🔹 FOOTER -->
    <footer class="bg-white text-gray-700 py-10 px-6 md:px-20 border-t border-gray-200">
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

        <div class="border-t border-gray-200 mt-8 pt-4 text-center text-sm text-gray-500">
            © {{ date('Y') }} ExGen Art Studio. All rights reserved.
        </div>
    </footer>

</body>

</html>
