@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg_login.png') }}');">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-xl flex-col gap-2 bg-white rounded-xl shadow-lg p-10 text-zinc-900 dark:text-zinc-900">
                <a href="" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-20 w-20 mb-1 items-center justify-center rounded-md">
                        <img
                            src="{{ asset('images/Logo_login.png') }}"
                            alt="Exgen Art & Design"
                            class="h-18 w-18 object-contain"
                        >
                    </span>
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
