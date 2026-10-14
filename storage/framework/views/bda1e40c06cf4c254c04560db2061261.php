

<?php $__env->startSection('content'); ?>

<div class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Edit Supplier
        </h1>

        <p class="mt-1 text-gray-500">
            Ubah informasi supplier pada sistem Stockify.
        </p>
    </div>

    <form action="<?php echo e(route('suppliers.update', $supplier->id)); ?>" method="POST">

        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="mb-5">
            <label
                for="name"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Nama Supplier
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="<?php echo e(old('name', $supplier->name)); ?>"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >
        </div>

        
        <div class="mb-5">
            <label
                for="phone"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Telepon
            </label>

            <input
                type="text"
                id="phone"
                name="phone"
                value="<?php echo e(old('phone', $supplier->phone)); ?>"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >
        </div>

        
        <div class="mb-5">
            <label
                for="email"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="<?php echo e(old('email', $supplier->email)); ?>"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >
        </div>

        
        <div class="mb-6">
            <label
                for="address"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Alamat
            </label>

            <textarea
                id="address"
                name="address"
                rows="4"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            ><?php echo e(old('address', $supplier->address)); ?></textarea>
        </div>

        
        <div class="flex items-center gap-3">

            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
            >
                Simpan Perubahan
            </button>

            <a
                href="<?php echo e(route('suppliers.index')); ?>"
                class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-300"
            >
                Batal
            </a>

        </div>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/suppliers/edit.blade.php ENDPATH**/ ?>