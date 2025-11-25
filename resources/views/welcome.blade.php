<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExGen Art Studio</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <style>
        /* Font inter agar mirip desain */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* CSS RESET UNTUK SWIPER */
        .swiper-slide {
            width: 100% !important;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }
    </style>
</head>

<body class="font-sans bg-white text-gray-800">

    <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-50" data-aos="fade-down" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-4 px-6 md:px-10">
            <div class="flex items-center gap-8 font-semibold">
                <a href="#home" class="hover:text-blue-500 transition">Home</a>
                <a href="#gallery-event" class="hover:text-blue-500 transition">Gallery</a>
                <a href="/lomba" class="hover:text-blue-500 transition">Event</a>
            </div>
            <div class="font-black text-xl tracking-tighter text-gray-900">EXGEN</div>
        </div>
    </nav>

    <section id="home" class="relative w-full h-screen flex flex-col items-center justify-center overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <img src="{{ asset('images/bg1.png') }}" alt="background" class="w-full h-full object-cover opacity-80">
        </div>

        <div
            class="hidden lg:block absolute right-0 top-1/2 transform -translate-y-1/2 h-full w-auto max-h-screen z-0 pointer-events-none">
            <img src="{{ asset('images/exter.png') }}" alt="Exter" class="h-full w-auto object-cover"
                data-aos="fade-left" data-aos-duration="1500" data-aos-delay="300">
        </div>

        <div class="relative z-10 flex flex-col items-center justify-center px-4 text-center" data-aos="fade-up"
            data-aos-duration="1200">
            <img src="{{ asset('images/logo.png') }}" alt="Logo ExGen" class="h-32 md:h-48 w-auto mb-6 drop-shadow-lg">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 text-gray-800 drop-shadow-sm">EXGEN ART STUDIO</h1>
            <p class="max-w-2xl mx-auto text-base md:text-xl text-gray-700 leading-relaxed">
                Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik.
            </p>
        </div>
    </section>

    <section id="pengajar"
        class="relative w-full min-h-screen flex items-center justify-center bg-white overflow-hidden">
        <div class="swiper swiper-pengajar w-full" data-aos="fade-up" data-aos-duration="1000">
            <div class="swiper-wrapper">
                @if (isset($pengajar))
                    @foreach ($pengajar as $p)
                        <div class="swiper-slide">
                            <div class="w-full h-full flex items-center justify-center px-6 py-12 md:px-0">
                                <div
                                    class="flex flex-col md:flex-row items-center gap-10 md:gap-32 max-w-7xl mx-auto select-none cursor-grab active:cursor-grabbing">
                                    <div
                                        class="w-[320px] h-[450px] md:w-[500px] md:h-[700px] bg-[#c8c3c3] rounded-[3rem] overflow-hidden flex-shrink-0 shadow-2xl relative z-10">
                                        @if ($p->foto)
                                            <img src="{{ asset('images/pengajar/' . $p->foto) }}"
                                                class="w-full h-full object-cover pointer-events-none"
                                                alt="{{ $p->nama }}">
                                        @else
                                            <div class="w-full h-full bg-[#c8c3c3]"></div>
                                        @endif
                                    </div>
                                    <div class="flex-1 text-center md:text-left max-w-2xl px-4 md:px-0">
                                        <h2
                                            class="text-5xl md:text-7xl font-bold text-black mb-8 leading-tight tracking-tight">
                                            {{ $p->nama }}
                                        </h2>
                                        <p class="text-gray-500 text-lg md:text-2xl leading-relaxed font-medium">
                                            {{ $p->deskripsi }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="relative text-center min-h-screen flex flex-col items-center justify-center py-20 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <img src="{{ asset('images/bg2.png') }}" alt="background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/5"></div>
        </div>

        <div class="w-full px-6 md:px-12 lg:px-16 xl:px-24 relative z-10">
            <div class="mb-12 md:mb-16" data-aos="zoom-in" data-aos-duration="1000">
                <h2 class="text-4xl md:text-6xl font-black text-white drop-shadow-lg tracking-tight">
                    Kelas di ExGen ini ada apa aja sih?
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-8 lg:gap-10">
                <div onclick="toggleCard(this)" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000"
                    class="bg-white/90 p-6 md:p-12 rounded-[2rem] md:rounded-[2.5rem] shadow-2xl w-full hover:scale-105 transition-all duration-300 flex flex-col justify-between cursor-pointer md:cursor-default h-auto md:min-h-[500px] group">
                    <div class="flex justify-between items-center w-full">
                        <h3 class="text-2xl md:text-4xl font-extrabold text-gray-900 tracking-tight text-left">Kelas
                            Lomba</h3>
                        <span
                            class="arrow-icon md:hidden text-2xl text-gray-500 transition-transform duration-300">▼</span>
                    </div>
                    <div class="card-content hidden md:flex flex-col justify-between h-full mt-4 md:mt-6">
                        <ul
                            class="text-left text-gray-700 text-sm md:text-lg font-medium space-y-3 pl-2 md:pl-4 list-disc list-outside leading-relaxed">
                            <li>Belajar teknik gradasi warna dan tekstur</li>
                            <li>Belajar penambahan objek gambar ala juara</li>
                            <li>Strategi cepat menyelesaikan gambar tepat waktu</li>
                        </ul>
                        <div class="flex justify-center pb-2 mt-6">
                            <div class="transform md:scale-125"><button class="btn-uiverse">Daftar</button></div>
                        </div>
                    </div>
                </div>

                <div onclick="toggleCard(this)" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"
                    class="bg-white/90 p-6 md:p-12 rounded-[2rem] md:rounded-[2.5rem] shadow-2xl w-full hover:scale-105 transition-all duration-300 flex flex-col justify-between cursor-pointer md:cursor-default h-auto md:min-h-[500px] group">
                    <div class="flex justify-between items-center w-full">
                        <h3 class="text-2xl md:text-4xl font-extrabold text-gray-900 tracking-tight text-left">Kelas
                            Seni Lukis</h3>
                        <span
                            class="arrow-icon md:hidden text-2xl text-gray-500 transition-transform duration-300">▼</span>
                    </div>
                    <div class="card-content hidden md:flex flex-col justify-between h-full mt-4 md:mt-6">
                        <ul
                            class="text-left text-gray-700 text-sm md:text-lg font-medium space-y-3 pl-2 md:pl-4 list-disc list-outside leading-relaxed">
                            <li>Belajar teknik dasar lukis (Cat minyak, Akrilik, atau Cat air)</li>
                            <li>Eksplorasi teknik <i>Mix Media</i></li>
                            <li>Pengembangan gaya lukisan personal</li>
                        </ul>
                        <div class="flex justify-center pb-2 mt-6">
                            <div class="transform md:scale-125"><button class="btn-uiverse">Daftar</button></div>
                        </div>
                    </div>
                </div>

                <div onclick="toggleCard(this)" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000"
                    class="bg-white/90 p-6 md:p-12 rounded-[2rem] md:rounded-[2.5rem] shadow-2xl w-full hover:scale-105 transition-all duration-300 flex flex-col justify-between cursor-pointer md:cursor-default h-auto md:min-h-[500px] group">
                    <div class="flex justify-between items-center w-full">
                        <h3 class="text-2xl md:text-4xl font-extrabold text-gray-900 tracking-tight text-left">Kelas
                            Fun Art</h3>
                        <span
                            class="arrow-icon md:hidden text-2xl text-gray-500 transition-transform duration-300">▼</span>
                    </div>
                    <div class="card-content hidden md:flex flex-col justify-between h-full mt-4 md:mt-6">
                        <ul
                            class="text-left text-gray-700 text-sm md:text-lg font-medium space-y-3 pl-2 md:pl-4 list-disc list-outside leading-relaxed">
                            <li>Belajar teknik dasar mewarnai dari nol (Gradasi & Mixing)</li>
                            <li>Belajar menambahkan objek gambar kreatif</li>
                            <li>Teknik menghias gambar agar lebih hidup</li>
                        </ul>
                        <div class="flex justify-center pb-2 mt-6">
                            <div class="transform md:scale-125"><button class="btn-uiverse">Daftar</button></div>
                        </div>
                    </div>
                </div>

                <div onclick="toggleCard(this)" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000"
                    class="bg-white/90 p-6 md:p-12 rounded-[2rem] md:rounded-[2.5rem] shadow-2xl w-full hover:scale-105 transition-all duration-300 flex flex-col justify-between cursor-pointer md:cursor-default h-auto md:min-h-[500px] group">
                    <div class="flex justify-between items-center w-full">
                        <h3 class="text-2xl md:text-4xl font-extrabold text-gray-900 tracking-tight text-left">Kelas
                            FSRD</h3>
                        <span
                            class="arrow-icon md:hidden text-2xl text-gray-500 transition-transform duration-300">▼</span>
                    </div>
                    <div class="card-content hidden md:flex flex-col justify-between h-full mt-4 md:mt-6">
                        <ul
                            class="text-left text-gray-700 text-sm md:text-lg font-medium space-y-3 pl-2 md:pl-4 list-disc list-outside leading-relaxed">
                            <li>Belajar teknik anatomi manusia</li>
                            <li>Studi gerak dan gestur anatomi</li>
                            <li>Gambar naratif, konstruktif, dan perspektif</li>
                            <li>Bonus: Bimbingan portofolio tes masuk</li>
                        </ul>
                        <div class="flex justify-center pb-2 mt-6">
                            <div class="transform md:scale-125"><button class="btn-uiverse">Daftar</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-16 bg-white text-black overflow-hidden min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-6 flex flex-col gap-12 md:gap-20">

            <div id="gallery-event" class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-24">
                <h2 class="block md:hidden text-3xl font-bold text-black text-center w-full" data-aos="fade-up">
                    Gallery Kelas</h2>
                <div class="swiper swiper-event w-[320px] h-[320px] md:w-[500px] md:h-[500px] rounded-[2rem] overflow-hidden shadow-sm bg-gray-300"
                    data-aos="fade-right" data-aos-duration="1200">
                    <div class="swiper-wrapper">
                        @if (isset($galleryEvent))
                            @foreach ($galleryEvent as $file)
                                <div class="swiper-slide">
                                    <img src="{{ asset('images/event/' . basename($file)) }}"
                                        class="w-full h-full object-cover pointer-events-none" alt="Gallery Event">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="w-full md:w-1/2 flex flex-col items-center md:items-center" data-aos="fade-left"
                    data-aos-duration="1200">
                    <h2 class="hidden md:block text-3xl md:text-5xl font-bold mb-4 text-black text-center">Gallery
                        Kelas</h2>
                    <p class="text-gray-500 text-base md:text-lg leading-relaxed max-w-lg text-justify">
                        Kumpulan dokumentasi ini mengabadikan konsentrasi, kreativitas, dan imajinasi para peserta saat
                        mereka menuangkan ide ke atas kanvas.
                    </p>
                </div>
            </div>

            <div id="gallery-karya"
                class="flex flex-col md:flex-row-reverse items-center justify-center gap-6 md:gap-24">
                <h2 class="block md:hidden text-3xl font-bold text-black text-center w-full" data-aos="fade-up">
                    Gallery Karya</h2>
                <div class="swiper swiper-karya w-[320px] h-[320px] md:w-[500px] md:h-[500px] rounded-[2rem] overflow-hidden shadow-sm bg-gray-300"
                    data-aos="fade-left" data-aos-duration="1200">
                    <div class="swiper-wrapper">
                        @if (isset($galleryKarya))
                            @foreach ($galleryKarya as $file)
                                <div class="swiper-slide">
                                    <img src="{{ asset('images/karya/' . basename($file)) }}"
                                        class="w-full h-full object-cover pointer-events-none" alt="Gallery Karya">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="w-full md:w-1/2 flex flex-col items-center md:items-center" data-aos="fade-right"
                    data-aos-duration="1200">
                    <h2 class="hidden md:block text-3xl md:text-5xl font-bold mb-4 text-black text-center">Gallery
                        Karya</h2>
                    <p class="text-gray-500 text-base md:text-lg leading-relaxed max-w-lg text-justify">
                        Setiap gambar, proyek, dan karya seni di sini adalah bukti nyata dari proses belajar, inovasi,
                        dan dedikasi mereka.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-32 md:py-48 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <img src="{{ asset('images/bg2.png') }}" alt="background"
                class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-r from-white/60 to-transparent"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 md:px-10 relative z-10" data-aos="fade-up" data-aos-duration="1200">
            <div class="flex flex-col items-start text-left max-w-4xl">
                <h2 class="text-5xl md:text-7xl font-black text-black mb-6 leading-tight tracking-tight">Event Exgen
                    Art Studio</h2>
                <p class="text-gray-700 text-lg md:text-2xl leading-relaxed mb-10 max-w-3xl text-justify">
                    Bukan hanya sekedar kelas <span class="font-semibold">seni</span> biasa, Exgen Art Studio juga
                    mengadakan berbagai macam event menarik yang bisa kamu ikuti.
                </p>
                <div class="transform scale-125 origin-left">
                    <a href="/lomba"><button class="btn-uiverse">Event</button></a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-12 px-4 sm:px-6 lg:px-8" data-aos="fade-up" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-10">Hubungi kami</h2>
            <div class="flex flex-col lg:flex-row gap-10 items-center">
                <div class="w-full lg:w-3/5 rounded-lg shadow-xl overflow-hidden aspect-video">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31690.686493714667!2d107.50004887649169!3d-6.850288930619117!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e477892906ef%3A0x9e74cf1bf52a6148!2sCipageran%2C%20Cimahi%20Utara%2C%20Cimahi%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1763603990275!5m2!1sen!2sid"
                        class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="w-full lg:w-2/5 p-6 space-y-6">
                    <div class="text-xl">
                        <p class="font-bold text-gray-700 mb-1">Alamat :</p>
                        <p class="text-gray-900">Jl. Encep Kartawirya No.36 RT.02/RW.03, Cimahi Utara, Jawa Barat</p>
                    </div>
                    <div class="text-xl">
                        <p class="font-bold text-gray-700 mb-1">Kontak :</p>
                        <div class="flex items-center space-x-3 mb-2">
                            <span class="text-pink-600 font-bold">IG</span>
                            <a href="https://www.instagram.com/exgen.artstudio_" target="_blank"
                                class="text-gray-900 hover:text-pink-600 transition duration-150">@exgen.artstudio_</a>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-green-600 font-bold">WA</span>
                            <a href="tel:+62897-9171-808"
                                class="text-gray-900 hover:text-green-600 transition duration-150">+62897-9171-808</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white text-gray-700 py-10 px-6 md:px-20 border-t border-gray-200">
        <div
            class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-10 text-center md:text-left">
            <div class="flex-shrink-0"><img src="{{ asset('images/logo.png') }}" alt="Logo"
                    class="h-24 mx-auto md:mx-0"></div>
            <div>
                <h3 class="font-semibold text-lg">ExGen Art Studio</h3>
                <p class="text-sm text-gray-500 mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="mt-3 text-sm">
                    <p class="text-gray-500">📧 E-mail: apotek@gmail.com</p>
                    <p class="text-gray-500">📞 Phone: 12345678910</p>
                </div>
            </div>
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

    <a href="https://wa.me/6289518495415" target="_blank"
        class="fixed bottom-6 right-6 z-50 transform scale-125 origin-bottom-right transition-transform duration-300 hover:scale-135">
        <button class="btn-wa">
            <div class="sign-wa">
                <svg class="socialSvg whatsappSvg" viewBox="0 0 16 16">
                    <path
                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
                    </path>
                </svg>
            </div>
            <div class="text-wa">WhatsApp</div>
        </button>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // INIT AOS
        AOS.init({
            once: false,
            mirror: true,
            offset: 100,
            duration: 1000,
        });

        // TOGGLE CARD MOBILE
        function toggleCard(card) {
            if (window.innerWidth < 768) {
                const content = card.querySelector('.card-content');
                const arrow = card.querySelector('.arrow-icon');
                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    content.classList.add('flex');
                    arrow.style.transform = 'rotate(180deg)';
                } else {
                    content.classList.add('hidden');
                    content.classList.remove('flex');
                    arrow.style.transform = 'rotate(0deg)';
                }
            }
        }

        // SWIPER INIT
        document.addEventListener("DOMContentLoaded", function() {
            const commonConfig = {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false
                },
                speed: 600,
                effect: "slide",
                grabCursor: true,
                observer: true,
                observeParents: true,
                keyboard: {
                    enabled: true
                }
            };

            // Profile Pengajar
            const pengajarEl = document.querySelector('.swiper-pengajar');
            const pengajarSlides = document.querySelectorAll('.swiper-pengajar .swiper-slide');
            if (pengajarEl && pengajarSlides.length > 1) {
                new Swiper(".swiper-pengajar", commonConfig);
            } else if (pengajarEl) {
                new Swiper(".swiper-pengajar", {
                    ...commonConfig,
                    loop: false,
                    autoplay: false
                });
            }

            // Gallery Event
            const eventEl = document.querySelector('.swiper-event');
            const eventSlides = document.querySelectorAll('.swiper-event .swiper-slide');
            if (eventEl && eventSlides.length > 1) {
                new Swiper(".swiper-event", commonConfig);
            } else if (eventEl) {
                new Swiper(".swiper-event", {
                    ...commonConfig,
                    loop: false,
                    autoplay: false
                });
            }

            // Gallery Karya
            const karyaEl = document.querySelector('.swiper-karya');
            const karyaSlides = document.querySelectorAll('.swiper-karya .swiper-slide');
            if (karyaEl && karyaSlides.length > 1) {
                new Swiper(".swiper-karya", commonConfig);
            } else if (karyaEl) {
                new Swiper(".swiper-karya", {
                    ...commonConfig,
                    loop: false,
                    autoplay: false
                });
            }
        });
    </script>

</body>

</html>