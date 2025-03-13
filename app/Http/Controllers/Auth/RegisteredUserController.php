<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role; // Import Spatie Role

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Mengambil semua role yang ada
        $roles = Role::all();
        return view('auth.register', compact('roles')); // Menyertakan role dalam view
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed'],
            'role' => ['required', 'string', 'exists:roles,name'], // Validasi role yang dipilih
        ]);

        // Simpan data user ke tabel `users`
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role yang dipilih oleh pengguna
        $user->assignRole($request->role); // Menambahkan role ke user

        // Meng-trigger event Registered
        event(new Registered($user));

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke halaman login atau halaman lain
        return redirect(route('login', absolute: false))->with('success', 'Registration successful');
    }
}
