<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Lomba | ExGen Art Studio</title>

    <link rel="icon" href="<?php echo e(asset('images/logo.png')); ?>" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/logo.png')); ?>">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Clear Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        @font-face {
            font-family: 'Clear Sans';
            src: url('font/ClearSans-Regular.woff') format('woff');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Clear Sans';
            src: url('font/ClearSans-Bold.woff') format('woff');
            font-weight: 700;
            font-style: normal;
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        button,
        li,
        div {
            font-family: 'Clear Sans', sans-serif !important;
        }

        body {
            overflow-x: hidden;
        }

        /* Smooth transition untuk line-clamp jika didukung browser */
        .description-text {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="font-sans bg-white text-gray-800 antialiased flex flex-col min-h-screen">

    <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-50 transition-all duration-300" id="navbar"
        data-aos="fade-down" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto flex items-center justify-start gap-12 py-4 px-6 md:px-10">
            <div class="flex items-center gap-8 font-semibold">
                <a href="<?php echo e(Request::is('/') ? '#home' : url('/')); ?>"
                    class="nav-link transition duration-300 <?php echo e(Request::is('/') ? 'text-[#1FA7AF] active-on-scroll' : 'text-gray-600 hover:text-[#1FA7AF]'); ?>"
                    data-target="home">Home</a>
                <a href="<?php echo e(Request::is('/') ? '#gallery-event' : url('/#gallery-event')); ?>"
                    class="nav-link transition duration-300 <?php echo e(Request::is('/') ? 'text-gray-600 active-on-scroll' : 'text-gray-600 hover:text-[#1FA7AF]'); ?>"
                    data-target="gallery-event">Gallery</a>
                <a href="/lomba"
                    class="nav-link transition duration-300 <?php echo e(Request::is('lomba*') ? 'text-[#1FA7AF]' : 'text-gray-600 hover:text-[#1FA7AF]'); ?>">Event</a>
            </div>
        </div>
    </nav>

    <section id="event" class="flex-grow w-full py-28 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20" data-aos="zoom-in" data-aos-duration="1000">
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight mb-4">Event & Lomba</h1>
                <p class="text-gray-500 text-lg">Ikuti kegiatan seru dan asah kreativitasmu bersama kami.</p>
            </div>

            <?php if(isset($events) && $events->count()): ?>
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex flex-col md:flex-row items-start gap-10 md:gap-16 mb-20 last:mb-0"
                        data-aos="fade-up" data-aos-duration="1000" data-aos-delay="<?php echo e($loop->iteration * 150); ?>">

                        <div class="flex-shrink-0 w-full md:w-auto flex justify-center">
                            <div
                                class="w-[300px] md:w-[350px] h-auto bg-gray-100 rounded-2xl shadow-lg overflow-hidden relative group">

                                <img src="<?php echo e(asset('images/event-lomba/' . $event->photo)); ?>"
                                    alt="Poster <?php echo e($event->title); ?>"
                                    class="w-full h-auto block transition-transform duration-500 group-hover:scale-105">

                            </div>
                        </div>

                        <div
                            class="w-full md:flex-1 flex flex-col items-center md:items-start text-center md:text-left py-2">
                            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 leading-normal pb-1 line-clamp-none md:line-clamp-2"
                                title="<?php echo e($event->title); ?>">
                                <?php echo e($event->title); ?>

                            </h2>

                            
                            
                            <div x-data="{ expanded: false }" class="w-full md:max-w-2xl">

                                <div class="text-gray-600 text-base md:text-lg leading-relaxed text-justify mb-2 description-text"
                                    :class="expanded ? '' : 'line-clamp-4'">
                                    <?php echo e($event->description); ?>

                                </div>

                                
                                <?php if(Str::length($event->description) > 200): ?>
                                    <button @click="expanded = !expanded"
                                        class="text-[#1FA7AF] font-bold text-sm hover:underline focus:outline-none mb-8 transition-colors duration-300">
                                        <span x-text="expanded ? 'Sembunyikan' : 'Selengkapnya...'"></span>
                                    </button>
                                <?php else: ?>
                                    
                                    <div class="mb-8"></div>
                                <?php endif; ?>

                            </div>
                            

                            <a href="https://wa.me/6289518495415?text=Halo,%20saya%20ingin%20mendaftar%20untuk%20<?php echo e(urlencode($event->title)); ?>"
                                target="_blank"
                                class="inline-flex items-center justify-center px-10 py-3 text-base font-bold text-white transition-all duration-200 bg-[#1FA7AF] rounded-full hover:bg-[#177c82] hover:shadow-lg hover:-translate-y-1">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>

                    <?php if(!$loop->last): ?>
                        <div class="w-full h-px bg-gray-100 my-16" data-aos="fade-in" data-aos-duration="800"></div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="flex flex-col items-center justify-center py-20 text-center" data-aos="fade-up">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600">Belum ada event tersedia</h3>
                </div>
            <?php endif; ?>
        </div>
    </section>

    
    <footer class="bg-white text-gray-700 py-10 px-6 md:px-20 border-t border-gray-200 mt-auto" data-aos="fade-up"
        data-aos-duration="1000">
        <div
            class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-center gap-10 text-center md:text-left">
            <div class="flex-shrink-0">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="h-20 mx-auto md:mx-0">
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
            © <?php echo e(date('Y')); ?> ExGen Art Studio. All rights reserved.
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

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            mirror: false,
            offset: 50,
            duration: 1000,
        });
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const homeSection = document.getElementById('home');
            if (homeSection) {
                const sections = document.querySelectorAll('section[id]');
                const navLinks = document.querySelectorAll('.active-on-scroll');
                window.addEventListener('scroll', () => {
                    let current = '';
                    sections.forEach(section => {
                        const sectionTop = section.offsetTop;
                        if (window.scrollY >= (sectionTop - 150)) {
                            current = section.getAttribute('id');
                        }
                    });
                    navLinks.forEach(link => {
                        link.classList.remove('text-[#1FA7AF]');
                        link.classList.add('text-gray-600');
                        if (link.getAttribute('data-target') === current) {
                            link.classList.remove('text-gray-600');
                            link.classList.add('text-[#1FA7AF]');
                        }
                    });
                    if (window.scrollY < 100) {
                        const homeLink = document.querySelector('a[data-target="home"]');
                        if (homeLink) {
                            navLinks.forEach(l => l.classList.remove('text-[#1FA7AF]'));
                            homeLink.classList.add('text-[#1FA7AF]');
                            homeLink.classList.remove('text-gray-600');
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
<?php /**PATH D:\PROJEK MANPROTI\exgenartstudio-main\resources\views/lomba.blade.php ENDPATH**/ ?>