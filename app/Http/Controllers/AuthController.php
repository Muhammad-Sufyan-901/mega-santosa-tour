<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        // Redirect to dashboard if already authenticated
        if (Auth::check()) {
            return redirect()->route('admin.dashboard.index');
        }

        $viewData = [
            'title' => 'Login',
        ];

        return view('auth.login', $viewData);
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        // Attempt to authenticate
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Authentication successful
            $request->session()->regenerate();
            
            return redirect()
                ->intended(route('admin.dashboard.index'))
                ->with('success', 'Login berhasil! Selamat datang di Admin Panel.');
        }

        // Authentication failed
        return redirect()
            ->back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->only('email'));
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()
            ->route('auth.login')
            ->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Create default admin user if none exists
     */
    public function createDefaultAdmin()
    {
        // Check if any user exists
        if (User::count() === 0) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@megasantosa.com',
                'password' => Hash::make('admin123'),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Default admin user created successfully.',
                'credentials' => [
                    'email' => 'admin@megasantosa.com',
                    'password' => 'admin123'
                ]
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Admin user already exists.'
        ]);
    }
}
