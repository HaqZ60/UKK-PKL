<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Daftar Akun Siswa')" :description="__('Masukkan email siswa yang terdaftar untuk membuat akun')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <div class="bg-blue-50 border border-blue-200 rounded-md p-3 text-sm text-blue-800">
        <strong>Informasi:</strong> Hanya siswa yang emailnya sudah terdaftar di sistem yang dapat membuat akun.
    </div>

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model.live="email"
            :label="__('Email Siswa')"
            type="email"
            required
            autocomplete="email"
            placeholder="contoh: 20388@student.stembayo.sch.id"
        />

        <!-- Name (Auto-filled) -->
        <flux:input
            wire:model="name"
            :label="__('Nama Lengkap')"
            type="text"
            required
            readonly="{{ $name ? 'true' : 'false' }}"
            autocomplete="name"
            :placeholder="$name ? '' : 'Nama akan terisi otomatis setelah email valid'"
            class="{{ $name ? 'bg-gray-100' : '' }}"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Buat password')"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Konfirmasi Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Ulangi password')"
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Daftar Akun') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Sudah punya akun?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Masuk') }}</flux:link>
    </div>
</div>
