
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Stockify - Admin Dashboard</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

    <script>
        (() => {
            try {
                const savedTheme = localStorage.getItem('stockify-theme');
                if (savedTheme === 'dark') {
                    document.documentElement.classList.add('theme-dark');
                }
            } catch (e) {}
        })();
    </script>

    <style>
        :root {
            color-scheme: light;
            --page-bg: #f3f6fc;
            --surface: #ffffff;
            --surface-soft: #f8faff;
            --text-main: #17233d;
            --text-muted: #64748b;
            --line: #e5eaf3;
            --input-bg: #ffffff;
        }

        html.theme-dark {
            color-scheme: dark;
            --page-bg: #0b1220;
            --surface: #111e32;
            --surface-soft: #172740;
            --text-main: #e8eefb;
            --text-muted: #a6b5cc;
            --line: #293a54;
            --input-bg: #15243b;
        }

        body {
            background: var(--page-bg);
            color: var(--text-main);
            transition: background .25s ease, color .25s ease;
        }

        .app-sidebar {
            background: linear-gradient(180deg, #1744c8 0%, #12359e 100%);
        }

        
.app-main {
    min-height: 100vh;
    width: calc(100% - 256px);
    min-width: 0;
    margin-left: 256px;
    overflow-x: clip;
    background: var(--page-bg);
    color: var(--text-main);
}

.app-main main {
    width: 100%;
    min-width: 0;
}

.app-main table {
    max-width: 100%;
}

.app-main img,
.app-main canvas {
    max-width: 100%;
}

@media (max-width: 767px) {
    .app-main {
        width: 100%;
        margin-left: 0;
    }
}


        .app-header {
            background: var(--surface);
            border-bottom: 1px solid var(--line);
            color: var(--text-main);
        }

        .app-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(25, 50, 100, .045);
            color: var(--text-main);
        }

        .app-muted {
            color: var(--text-muted);
        }

        .app-control {
            background: var(--input-bg);
            border: 1px solid var(--line);
            color: var(--text-main);
            border-radius: 10px;
        }

        .app-control::placeholder {
            color: var(--text-muted);
        }

        .app-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 13px;
            border-radius: 10px;
            color: #eaf0ff;
            font-size: 14px;
            font-weight: 500;
            transition: background .2s ease, transform .2s ease;
        }

        .app-nav-link:hover {
            background: rgba(255,255,255,.13);
            transform: translateX(2px);
        }

        .app-nav-link.active {
            background: linear-gradient(110deg, #3474ff, #2053e7);
            color: #fff;
            box-shadow: 0 5px 14px rgba(0, 0, 0, .12);
        }

        .app-nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .theme-dark body {
            background: var(--page-bg);
            color: var(--text-main);
        }

        .theme-dark .app-main {
            background: var(--page-bg);
            color: var(--text-main);
        }

        .theme-dark .bg-white,
        .theme-dark .bg-gray-50,
        .theme-dark .bg-gray-100,
        .theme-dark .bg-slate-50,
        .theme-dark .bg-slate-100 {
            background-color: var(--surface) !important;
        }

        .theme-dark .text-gray-900,
        .theme-dark .text-gray-800,
        .theme-dark .text-gray-700,
        .theme-dark .text-slate-900,
        .theme-dark .text-slate-800,
        .theme-dark .text-slate-700 {
            color: var(--text-main) !important;
        }

        .theme-dark .text-gray-600,
        .theme-dark .text-gray-500,
        .theme-dark .text-slate-600,
        .theme-dark .text-slate-500 {
            color: var(--text-muted) !important;
        }

        .theme-dark .border-gray-100,
        .theme-dark .border-gray-200,
        .theme-dark .border-gray-300,
        .theme-dark .border-slate-200 {
            border-color: var(--line) !important;
        }

        .theme-dark input:not([type="checkbox"]):not([type="radio"]),
        .theme-dark select,
        .theme-dark textarea {
            background-color: var(--input-bg);
            color: var(--text-main);
            border-color: var(--line);
        }

        .theme-dark input::placeholder,
        .theme-dark textarea::placeholder {
            color: var(--text-muted);
        }

        .theme-dark table thead {
            background-color: var(--surface-soft);
        }

        .theme-dark table tbody tr {
            background-color: var(--surface);
            border-color: var(--line);
        }

        .theme-dark table tbody tr:hover {
            background-color: var(--surface-soft);
        }

        .theme-dark .app-card {
            box-shadow: 0 8px 28px rgba(0, 0, 0, .12);
        }

        .theme-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border: 1px solid var(--line);
            background: var(--surface-soft);
            color: var(--text-main);
            border-radius: 12px;
            cursor: pointer;
            transition: all .2s ease;
        }

        .theme-toggle:hover {
            border-color: #3b82f6;
            transform: translateY(-1px);
        }

        @media (max-width: 767px) {
            .app-sidebar {
                position: relative !important;
                width: 100% !important;
                height: auto !important;
            }

            .app-main {
                margin-left: 0 !important;
            }

            .app-menu {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 5px;
            }
        }
    </style>
</head>

<body>
    <?php
        $role = auth()->user()->role;

        $menus = [
            [
                'name' => 'Dashboard',
                'route' => 'dashboard',
                'active' => 'dashboard',
                'icon' => 'grid',
                'roles' => ['admin'],
            ],
            [
                'name' => 'Produk',
                'route' => 'products.index',
                'active' => 'products.*',
                'icon' => 'box',
                'roles' => ['admin', 'manager', 'staff'],
            ],
            [
                'name' => 'Kategori',
                'route' => 'categories.index',
                'active' => 'categories.*',
                'icon' => 'layers',
                'roles' => ['admin'],
            ],
            [
                'name' => 'Supplier',
                'route' => 'suppliers.index',
                'active' => 'suppliers.*',
                'icon' => 'truck',
                'roles' => ['admin'],
            ],
            [
                'name' => 'Transaksi',
                'route' => 'transactions.index',
                'active' => 'transactions.*',
                'icon' => 'repeat',
                'roles' => ['admin', 'manager', 'staff'],
            ],
            [
                'name' => 'Stock Opname',
                'route' => 'stock-opnames.index',
                'active' => 'stock-opnames.*',
                'icon' => 'clipboard',
                'roles' => ['admin', 'manager', 'staff'],
            ],
            [
                'name' => 'Pengguna',
                'route' => 'users.index',
                'active' => 'users.*',
                'icon' => 'users',
                'roles' => ['admin'],
            ],
            [
                'name' => 'Laporan',
                'route' => 'reports.index',
                'active' => 'reports.*',
                'icon' => 'chart',
                'roles' => ['admin', 'manager'],
            ],
            [
                'name' => 'Profil',
                'route' => 'profile.edit',
                'active' => 'profile.*',
                'icon' => 'user',
                'roles' => ['admin', 'manager', 'staff'],
            ],
        ];
    ?>

    <div class="min-h-screen md:flex">

        <!-- SIDEBAR -->
        <aside class="app-sidebar fixed inset-y-0 left-0 z-40 flex h-screen w-64 flex-col text-white">
            <div class="flex items-center gap-3 px-6 py-6">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 2 22 7.5 12 13 2 7.5 12 2Z"/>
                        <path d="M2 7.5v9L12 22v-9M22 7.5v9L12 22"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-extrabold tracking-wide">STOCKIFY</h1>
                    <p class="text-xs text-blue-200">Inventory Management</p>
                </div>
            </div>

            <div class="mx-4 mb-4 rounded-xl border border-white/10 bg-white/10 px-4 py-3">
                <p class="text-xs text-blue-200">Masuk sebagai</p>
                <p class="mt-1 truncate text-sm font-semibold"><?php echo e(auth()->user()->name); ?></p>
                <p class="mt-1 text-xs capitalize text-blue-200"><?php echo e($role); ?></p>
            </div>

            <nav class="app-menu flex-1 space-y-1 overflow-y-auto px-3 pb-4">
                <p class="px-3 pb-2 pt-3 text-xs font-semibold uppercase tracking-widest text-blue-200">
                    Menu Utama
                </p>

                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($role, $menu['roles']) && Route::has($menu['route'])): ?>
                        <a href="<?php echo e(route($menu['route'])); ?>"
                           class="app-nav-link <?php echo e(request()->routeIs($menu['active']) ? 'active' : ''); ?>">
                            <?php switch($menu['icon']):
                                case ('grid'): ?>
                                    <svg class="app-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                                    <?php break; ?>
                                <?php case ('box'): ?>
                                    <svg class="app-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="M3 8v9l9 5 9-5V8M12 13v9"/></svg>
                                    <?php break; ?>
                                <?php case ('layers'): ?>
                                    <svg class="app-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 12 9 5 9-5M3 16l9 5 9-5"/></svg>
                                    <?php break; ?>
                                <?php case ('truck'): ?>
                                    <svg class="app-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 6h11v12H3zM14 10h4l3 4v4h-7"/><circle cx="7" cy="18" r="2"/><circle cx="18" cy="18" r="2"/></svg>
                                    <?php break; ?>
                                <?php case ('repeat'): ?>
                                    <svg class="app-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m17 2 4 4-4 4"/><path d="M3 11V9a3 3 0 0 1 3-3h15M7 22l-4-4 4-4"/><path d="M21 13v2a3 3 0 0 1-3 3H3"/></svg>
                                    <?php break; ?>
                                <?php case ('clipboard'): ?>
                                    <svg class="app-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="5" y="4" width="14" height="17" rx="2"/><path d="M9 4V2h6v2M8 10l2 2 4-4M8 16h8"/></svg>
                                    <?php break; ?>
                                <?php case ('users'): ?>
                                    <svg class="app-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0M16 5a3.5 3.5 0 0 1 0 7M18 14a5 5 0 0 1 3.5 5"/></svg>
                                    <?php break; ?>
                                <?php case ('chart'): ?>
                                    <svg class="app-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 3v18h18"/><path d="m7 14 4-4 3 3 6-7"/></svg>
                                    <?php break; ?>
                                <?php default: ?>
                                    <svg class="app-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
                            <?php endswitch; ?>
                            <span><?php echo e($menu['name']); ?></span>
                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>

            <div class="m-3 rounded-xl border border-white/10 bg-white/10 p-4">
                <p class="text-sm font-semibold">Kelola stok lebih mudah</p>
                <p class="mt-1 text-xs leading-5 text-blue-200">Pantau produk, transaksi, dan persediaan dalam satu tempat.</p>
            </div>

            <form method="POST" action="<?php echo e(route('logout')); ?>" class="p-3">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-red-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 17l5-5-5-5M15 12H3"/><path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"/></svg>
                    Logout
                </button>
            </form>
        </aside>

        <!-- AREA KONTEN -->
        <div class="app-main w-full flex-1">

            <!-- HEADER -->
            <header class="app-header sticky top-0 z-30 flex min-h-[76px] flex-wrap items-center justify-between gap-3 px-4 py-3 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                        class="rounded-lg border p-2 md:hidden" style="border-color:var(--line)">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div>
                        <p class="text-sm font-semibold">Stockify</p>
                        <p class="app-muted text-xs">Sistem Informasi Persediaan</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="hidden w-60 items-center gap-2 rounded-xl border px-3 py-2 lg:flex"
                        style="background:var(--surface-soft);border-color:var(--line)">
                        <svg class="app-muted h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                        <span class="app-muted text-xs">Persediaan &amp; transaksi</span>
                    </div>

                    <button type="button" id="theme-toggle" class="theme-toggle"
                        aria-label="Ganti mode tampilan" title="Ganti mode terang atau gelap">
                        <svg id="theme-sun" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"/></svg>
                        <svg id="theme-moon" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20.5 14.5A8.5 8.5 0 0 1 9.5 3.5 8.5 8.5 0 1 0 20.5 14.5Z"/></svg>
                    </button>

                    <div class="hidden h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white sm:flex">
                        <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                    </div>

                    <div class="hidden sm:block">
                        <p class="text-sm font-semibold"><?php echo e(auth()->user()->name); ?></p>
                        <p class="app-muted text-xs capitalize"><?php echo e($role); ?></p>
                    </div>
                </div>
            </header>

            <!-- MENU MOBILE -->
            <div id="mobile-menu" class="app-card mx-3 mt-3 hidden p-3 md:hidden">
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($role, $menu['roles']) && Route::has($menu['route'])): ?>
                        <a href="<?php echo e(route($menu['route'])); ?>"
                           class="app-nav-link <?php echo e(request()->routeIs($menu['active']) ? 'active' : ''); ?> mb-1"
                           style="color:var(--text-main)">
                            <?php echo e($menu['name']); ?>

                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <main class="p-4 sm:p-6 lg:p-8">
                <?php echo $__env->yieldContent('content'); ?>
            </main>

        </div>
    </div>

    <script>
        (() => {
            const root = document.documentElement;
            const button = document.getElementById('theme-toggle');
            const sun = document.getElementById('theme-sun');
            const moon = document.getElementById('theme-moon');

            function updateThemeIcon() {
                const dark = root.classList.contains('theme-dark');
                sun.classList.toggle('hidden', dark);
                moon.classList.toggle('hidden', !dark);
                button.setAttribute('aria-label', dark ? 'Gunakan mode terang' : 'Gunakan mode gelap');
            }

            updateThemeIcon();

            button.addEventListener('click', () => {
                const dark = root.classList.toggle('theme-dark');
                try {
                    localStorage.setItem('stockify-theme', dark ? 'dark' : 'light');
                } catch (e) {}
                updateThemeIcon();
            });
        })();
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\stockify\resources\views/layouts/admin.blade.php ENDPATH**/ ?>