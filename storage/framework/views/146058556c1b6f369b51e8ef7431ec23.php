<?php $__env->startSection('content'); ?>

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        Profil Pengguna
    </h1>

    <p class="mt-1 text-gray-500">
        Kelola informasi akun dan keamanan pengguna.
    </p>
</div>

<div class="space-y-6">

    
    <div class="rounded-xl bg-white p-6 shadow-sm">

        <div class="max-w-xl">
            <?php echo $__env->make('profile.partials.update-profile-information-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

    </div>

    
    <div class="rounded-xl bg-white p-6 shadow-sm">

        <div class="max-w-xl">
            <?php echo $__env->make('profile.partials.update-password-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

    </div>

    
    <div class="rounded-xl bg-white p-6 shadow-sm">

        <div class="max-w-xl">
            <?php echo $__env->make('profile.partials.delete-user-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/profile/edit.blade.php ENDPATH**/ ?>