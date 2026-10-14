

<?php $__env->startSection('content'); ?>

<div class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Edit Kategori
        </h1>

        <p class="mt-1 text-gray-500">
            Ubah data kategori produk.
        </p>
    </div>

    <form action="<?php echo e(route('categories.update', $category->id)); ?>" method="POST">

        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="mb-5">

            <label
                for="name"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Nama Kategori
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="<?php echo e(old('name', $category->name)); ?>"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >

        </div>

        
        <div class="mb-6">

            <label
                for="description"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Deskripsi
            </label>

            <textarea
                id="description"
                name="description"
                rows="4"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            ><?php echo e(old('description', $category->description)); ?></textarea>

        </div>

        
        <div class="flex items-center gap-3">

            <button
                type="submit"
                class="rounded-lg bg-green-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300"
            >
                Simpan Perubahan
            </button>

            <a
                href="<?php echo e(route('categories.index')); ?>"
                class="rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-600"
            >
                Kembali
            </a>

        </div>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/categories/edit.blade.php ENDPATH**/ ?>