<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Siswa\Form;
use App\Livewire\Siswa\Index as SiswaIndex;
use App\Livewire\Siswa\View as SiswaView;
use App\Livewire\Guru\Index;
use App\Livewire\Guru\View as GuruView;
use App\Livewire\Guru\Form as GuruForm;
use App\Livewire\Industri\Index as IndustriIndex;
use App\Livewire\Industri\View as IndustriView;
use App\Livewire\Industri\Form as IndustriForm;
use App\Livewire\Pkl\Form as PKLForm;
use App\Livewire\Pkl\View as PKLView;
use App\Livewire\Pkl\Index as PKLIndex;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', "role:siswa"])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('industri', IndustriIndex::class)->name('industri');
    Route::get('siswa', SiswaIndex::class)->name('siswa');
    Route::get('guru', Index::class)->name('guru');
    Route::get('pkl', PKLIndex::class)->name('pkl');
});


// HAPUS INI karena duplikat dan tidak perlu:
// Route::get('/industri', function () { return view('industri'); });

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    // Settings
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Siswa
    Route::get('/siswa/show/{id}', SiswaView::class)->name('siswa.show');
    Route::get('/siswa/create', Form::class)->name('siswa.create');
    Route::get('/siswa/edit/{id}', Form::class)->name('siswa.edit');

    // Guru
    Route::get('/guru/show/{id}', GuruView::class)->name('guru.show');
    Route::get('/guru/create', GuruForm::class)->name('guru.create');
    Route::get('/guru/edit/{id}', GuruForm::class)->name('guru.edit');

    // Industri
    Route::get('/industri/show/{id}', IndustriView::class)->name('industri.show');
    Route::get('/industri/create', IndustriForm::class)->name('industri.create');
    Route::get('/industri/edit/{id}', IndustriForm::class)->name('industri.edit');

    //PKL
    Route::get('/pkl/show/{id}', PKLView::class)->name('pkl.show');
    Route::get('/pkl/create', PKLForm::class)->name('pkl.create');
    Route::get('/pkl/edit/{id}', PKLForm::class)->name('pkl.edit');

});

require __DIR__.'/auth.php';
