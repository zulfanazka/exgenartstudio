<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <?php echo $__env->make('partials.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </head>
    <body class="min-h-screen bg-white antialiased bg-cover bg-center bg-no-repeat" style="background-image: url('<?php echo e(asset('images/bg_login.png')); ?>');">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-xl flex-col gap-2 bg-white rounded-xl shadow-lg p-10 text-zinc-900 dark:text-zinc-900">
                <a href="" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-20 w-20 mb-1 items-center justify-center rounded-md">
                        <img
                            src="<?php echo e(asset('images/Logo_login.png')); ?>"
                            alt="Exgen Art & Design"
                            class="h-18 w-18 object-contain"
                        >
                    </span>
                    <span class="sr-only"><?php echo e(config('app.name', 'Laravel')); ?></span>
                </a>
                <div class="flex flex-col gap-6">
                    <?php echo e($slot); ?>

                </div>
            </div>
        </div>
        <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

    </body>
</html>
<?php /**PATH D:\PROJEK MANPROTI\exgenartstudio-main\resources\views/components/layouts/auth/simple.blade.php ENDPATH**/ ?>