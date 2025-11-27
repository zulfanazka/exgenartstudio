<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Lomba | ExGen Art Studio</title>
    
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* CSS Wajib untuk memotong teks (Line Clamp) */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Maksimal 2 baris Judul */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            /* Maksimal 4 baris Deskripsi */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="font-sans bg-white text-gray-800 antialiased flex flex-col min-h-screen">

    <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-4 px-6 md:px-10">
            <div class="flex items-center gap-8 font-semibold text-gray-700">
                <a href="/" class="hover:text-blue-500 transition">Home</a>
                <a href="/#gallery-event" class="hover:text-blue-500 transition">Gallery</a>
                <a href="#event" class="hover:text-blue-500 transition">Event</a>
            </div>
        </div>
    </nav>

    <section id="event" class="flex-grow w-full py-28 px-6 bg-white">

        <div class="max-w-6xl mx-auto">

            <div class="text-center mb-20">
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight mb-4">Event & Lomba</h1>
                <p class="text-gray-500 text-lg">Ikuti kegiatan seru dan asah kreativitasmu bersama kami.</p>
            </div>

            @if (isset($events) && $events->count())
                @foreach ($events as $event)
                    <div class="flex flex-col md:flex-row items-start gap-10 md:gap-16 mb-20 last:mb-0">

                        <div class="flex-shrink-0 w-full md:w-auto flex justify-center">
                            <div
                                class="w-[300px] h-[420px] md:w-[350px] md:h-[500px] bg-gray-100 rounded-2xl shadow-lg overflow-hidden relative">
                                <img src="{{ asset('images/event-lomba/' . $event->photo) }}"
                                    alt="Poster {{ $event->title }}"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>

                        <div
                            class="w-full md:flex-1 flex flex-col items-center md:items-start text-center md:text-left py-2">

                            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight line-clamp-2"
                                title="{{ $event->title }}">
                                {{ $event->title }}
                            </h2>

                            <div
                                class="text-gray-600 text-base md:text-lg leading-relaxed mb-8 text-justify w-full md:max-w-2xl line-clamp-4">
                                {{ $event->description }}
                            </div>

                            <a href="https://wa.me/6289518495415?text=Halo,%20saya%20ingin%20mendaftar%20untuk%20{{ urlencode($event->title) }}" target="_blank"
                                class="inline-flex items-center justify-center px-10 py-3 text-base font-bold text-white transition-all duration-200 bg-blue-600 rounded-full hover:bg-blue-700 hover:shadow-lg hover:-translate-y-1">
                                Daftar Sekarang
                            </a>

                        </div>

                    </div>

                    @if (!$loop->last)
                        <div class="w-full h-px bg-gray-100 my-16"></div>
                    @endif
                @endforeach
            @else
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600">Belum ada event tersedia</h3>
                </div>
            @endif

        </div>
    </section>

    <footer class="bg-white text-gray-700 py-10 px-6 md:px-20 border-t border-gray-200 mt-auto">
        <div
            class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-center gap-10 text-center md:text-left">
            <div class="flex-shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 mx-auto md:mx-0">
            </div>
            <div>
                <h3 class="font-semibold text-lg">ExGen Art Studio</h3>
                <p class="text-sm text-gray-500 mt-1">Wadah kreativitas untuk generasi muda.</p>
                <div class="mt-3 text-sm space-y-1">
                    <p>📧 exgen.artstudio@gmail.com</p>
                    <p>📞 +62 895-1849-5415</p>
                </div>
            </div>
            <div>
                <h3 class="font-semibold mb-2 text-lg">Company</h3>
                <ul class="text-sm space-y-1 text-gray-500">
                    <li><a href="/" class="hover:text-blue-500 transition">Home</a></li>
                    <li><a href="/#gallery-event" class="hover:text-blue-500 transition">Gallery</a></li>
                    <li><a href="#event" class="hover:text-blue-500 transition">Event</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-200 mt-8 pt-4 text-center text-sm text-gray-500">
            © {{ date('Y') }} ExGen Art Studio. All rights reserved.
        </div>
    </footer>

</body>

</html>