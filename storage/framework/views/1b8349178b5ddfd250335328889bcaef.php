

<?php $__env->startSection('content'); ?>

<?php
    $totalUsers = $users->count();
    $totalAdmins = $users->where('role', 'admin')->count();
    $totalManagers = $users->where('role', 'manager')->count();
    $totalStaff = $users->where('role', 'staff')->count();
?>

<div id="users-page">

    <style>
        #users-page {
            color: #1f2937;
        }

        #users-page .user-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        }

        #users-page .user-table-wrap {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            overflow: hidden;
        }

        #users-page .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        #users-page .user-table th {
            padding: 15px 20px;
            background: #1d4ed8;
            color: #ffffff;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        #users-page .user-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        #users-page .user-table tbody tr:last-child td {
            border-bottom: none;
        }

        #users-page .user-table tbody tr:hover {
            background: #f8fafc;
        }

        #users-page .user-search {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 11px 14px;
            outline: none;
            background: #ffffff;
            color: #111827;
        }

        #users-page .user-search:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
        }

        #users-page .user-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border-radius: 9px;
            padding: 9px 13px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        #users-page .user-btn-edit {
            background: #fef3c7;
            color: #92400e;
        }

        #users-page .user-btn-delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        #users-page .user-btn-add {
            background: #2563eb;
            color: #ffffff;
            padding: 11px 17px;
        }

        #users-page .user-btn-add:hover {
            background: #1d4ed8;
        }

        #users-page .user-alert {
            border-radius: 12px;
            padding: 13px 16px;
            margin-bottom: 18px;
        }

        #users-page .user-role {
            display: inline-block;
            border-radius: 999px;
            padding: 5px 11px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        #users-page .role-admin {
            background: #ede9fe;
            color: #6d28d9;
        }

        #users-page .role-manager {
            background: #dbeafe;
            color: #1d4ed8;
        }

        #users-page .role-staff {
            background: #f3f4f6;
            color: #4b5563;
        }

        #users-page .user-avatar {
            display: flex;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 15px;
            font-weight: 800;
        }

        #users-page .user-muted {
            color: #6b7280;
        }

        html.theme-dark #users-page {
            color: #e5e7eb;
        }

        html.theme-dark #users-page .user-card,
        html.theme-dark #users-page .user-table-wrap {
            background: #1f2937;
            border-color: #374151;
        }

        html.theme-dark #users-page .user-table th {
            background: #1e40af;
        }

        html.theme-dark #users-page .user-table td {
            border-color: #374151;
        }

        html.theme-dark #users-page .user-table tbody tr {
            background: #1f2937;
        }

        html.theme-dark #users-page .user-table tbody tr:hover {
            background: #273449;
        }

        html.theme-dark #users-page .user-search {
            background: #111827;
            color: #f9fafb;
            border-color: #4b5563;
        }

        html.theme-dark #users-page .user-muted {
            color: #9ca3af;
        }

        html.theme-dark #users-page .user-avatar {
            background: #1e3a8a;
            color: #bfdbfe;
        }

        html.theme-dark #users-page .role-admin {
            background: #4c1d95;
            color: #ede9fe;
        }

        html.theme-dark #users-page .role-manager {
            background: #1e3a8a;
            color: #dbeafe;
        }

        html.theme-dark #users-page .role-staff {
            background: #374151;
            color: #e5e7eb;
        }

        html.theme-dark #users-page .user-btn-edit {
            background: #78350f;
            color: #fef3c7;
        }

        html.theme-dark #users-page .user-btn-delete {
            background: #7f1d1d;
            color: #fee2e2;
        }

        @media (max-width: 640px) {
            #users-page .user-card {
                padding: 15px;
            }

            #users-page .user-table th,
            #users-page .user-table td {
                padding: 12px;
            }
        }
    </style>

    
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-bold sm:text-3xl">Pengguna</h1>
            <p class="user-muted mt-1 text-sm">
                Kelola akun dan hak akses pengguna Stockify.
            </p>
        </div>

        <a href="<?php echo e(route('users.create')); ?>" class="user-btn user-btn-add">
            <span class="text-lg">+</span>
            Tambah Pengguna
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="user-alert border border-green-200 bg-green-50 text-green-700">
            <strong>Berhasil!</strong> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <?php if(session('error')): ?>
        <div class="user-alert border border-red-200 bg-red-50 text-red-700">
            <strong>Gagal!</strong> <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="user-card">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="user-muted text-sm">Total Pengguna</p>
                    <h2 class="mt-2 text-3xl font-bold"><?php echo e($totalUsers); ?></h2>
                </div>
                <div class="rounded-xl bg-blue-100 p-3 text-2xl">👥</div>
            </div>
        </div>

        <div class="user-card">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="user-muted text-sm">Administrator</p>
                    <h2 class="mt-2 text-3xl font-bold"><?php echo e($totalAdmins); ?></h2>
                </div>
                <div class="rounded-xl bg-purple-100 p-3 text-2xl">🛡️</div>
            </div>
        </div>

        <div class="user-card">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="user-muted text-sm">Manager</p>
                    <h2 class="mt-2 text-3xl font-bold"><?php echo e($totalManagers); ?></h2>
                </div>
                <div class="rounded-xl bg-blue-100 p-3 text-2xl">📊</div>
            </div>
        </div>

        <div class="user-card">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="user-muted text-sm">Staff</p>
                    <h2 class="mt-2 text-3xl font-bold"><?php echo e($totalStaff); ?></h2>
                </div>
                <div class="rounded-xl bg-gray-100 p-3 text-2xl">🧑‍💻</div>
            </div>
        </div>

    </div>

    
    <div class="user-table-wrap">

        <div class="flex flex-col gap-4 border-b border-gray-200 p-5 sm:flex-row sm:items-center sm:justify-between"
             style="border-color: inherit;">

            <div>
                <h2 class="text-lg font-bold">Daftar Pengguna</h2>
                <p class="user-muted mt-1 text-sm">
                    Data akun yang terdaftar di sistem.
                </p>
            </div>

            <div class="w-full sm:max-w-xs">
                <input
                    type="text"
                    id="searchUser"
                    class="user-search"
                    placeholder="Cari nama, email, atau role..."
                    autocomplete="off"
                >
            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="user-table text-sm" id="userTable">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="user-row">

                            <td class="user-muted">
                                <?php echo e($loop->iteration); ?>

                            </td>

                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="user-avatar">
                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                    </div>

                                    <div>
                                        <p class="font-semibold">
                                            <?php echo e($user->name); ?>

                                        </p>
                                        <p class="user-muted mt-1 text-xs">
                                            ID: <?php echo e($user->id); ?>

                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span><?php echo e($user->email); ?></span>
                            </td>

                            <td>
                                <?php if($user->role === 'admin'): ?>
                                    <span class="user-role role-admin">Admin</span>
                                <?php elseif($user->role === 'manager'): ?>
                                    <span class="user-role role-manager">Manager</span>
                                <?php else: ?>
                                    <span class="user-role role-staff">
                                        <?php echo e(ucfirst($user->role ?? 'staff')); ?>

                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="flex items-center gap-2">

                                    <a
                                        href="<?php echo e(route('users.edit', $user)); ?>"
                                        class="user-btn user-btn-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="<?php echo e(route('users.destroy', $user)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pengguna <?php echo e(addslashes($user->name)); ?>?')"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="submit" class="user-btn user-btn-delete">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr id="emptyUsersRow">
                            <td colspan="5" class="user-muted py-10 text-center">
                                <div class="mb-2 text-3xl">👥</div>
                                <p class="font-semibold">Belum ada data pengguna.</p>
                                <p class="mt-1 text-xs">Tambahkan pengguna untuk mulai mengelola akun.</p>
                            </td>
                        </tr>

                    <?php endif; ?>

                    <tr id="noSearchResults" style="display: none;">
                        <td colspan="5" class="user-muted py-8 text-center">
                            Pengguna yang dicari tidak ditemukan.
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <div class="user-muted border-t border-gray-200 px-5 py-4 text-xs"
             style="border-color: inherit;">
            Total data pada halaman ini: <?php echo e($totalUsers); ?> pengguna
        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchUser');
        const table = document.getElementById('userTable');

        if (!searchInput || !table) {
            return;
        }

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr.user-row');
            const noResults = document.getElementById('noSearchResults');
            let visibleRows = 0;

            rows.forEach(function (row) {
                const matches = row.textContent.toLowerCase().includes(keyword);

                row.style.display = matches ? '' : 'none';

                if (matches) {
                    visibleRows++;
                }
            });

            if (noResults) {
                noResults.style.display =
                    rows.length > 0 && visibleRows === 0 ? '' : 'none';
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/users/index.blade.php ENDPATH**/ ?>