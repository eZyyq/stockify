@extends('layouts.admin')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        Profil Pengguna
    </h1>

    <p class="mt-1 text-gray-500">
        Kelola informasi akun dan keamanan pengguna.
    </p>
</div>

<div class="space-y-6">

    {{-- Informasi Profil --}}
    <div class="rounded-xl bg-white p-6 shadow-sm">

        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>

    </div>

    {{-- Ubah Password --}}
    <div class="rounded-xl bg-white p-6 shadow-sm">

        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>

    </div>

    {{-- Hapus Akun --}}
    <div class="rounded-xl bg-white p-6 shadow-sm">

        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>

    </div>

</div>

@endsection