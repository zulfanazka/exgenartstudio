<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main container class="!bg-black">
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>