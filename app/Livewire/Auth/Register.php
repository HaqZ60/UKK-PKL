<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Auto-fill name when valid email is entered
     */
    public function updatedEmail()
    {
        if ($this->email) {
            $siswa = Siswa::where('email', $this->email)->first();
            if ($siswa) {
                $this->name = $siswa->nama;
            } else {
                $this->name = '';
            }
        }
    }

    /**
     * Custom validation messages
     */
    protected function messages()
    {
        return [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar sebagai user.',
            'name.required' => 'Nama harus diisi.',
            'password.required' => 'Password harus diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255', 
                'unique:'.User::class,
                function ($attribute, $value, $fail) {
                    if (!Siswa::where('email', $value)->exists()) {
                        $fail('Email tidak terdaftar sebagai siswa. Silakan hubungi administrator.');
                    }
                }
            ],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Get the siswa record to use their name
        $siswa = Siswa::where('email', $validated['email'])->first();
        
        $validated['password'] = Hash::make($validated['password']);
        $validated['name'] = $siswa->nama; // Use siswa's name instead of input name

        $user = User::create($validated);
        $user->assignRole('siswa');

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
