<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showAuth(): View
    {
        return view('auth.index', [
            'step' => 'identify',
            'mobile' => old('mobile'),
            'nationalId' => old('national_id'),
        ]);
    }

    public function identify(Request $request): View|RedirectResponse
    {
        $data = $request->validate([
            'mobile' => ['required', 'string', 'max:20'],
            'national_id' => ['required', 'string', 'size:10', 'regex:/^[0-9۰-۹]{10}$/'],
        ]);

        $user = User::where('mobile', $data['mobile'])
            ->where('national_id', $data['national_id'])
            ->first();

        if ($user) {
            if ($user->status !== 'active') {
                return back()->withErrors(['mobile' => 'این حساب در حال حاضر فعال نیست.']);
            }

            Auth::login($user);
            $request->session()->regenerate();

            return $user->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('account.dashboard');
        }

        return view('auth.index', [
            'step' => 'details',
            'mobile' => $data['mobile'],
            'nationalId' => $data['national_id'],
        ])->with('info', 'حسابی با این مشخصات پیدا نشد. برای ساخت حساب، اطلاعات زیر را تکمیل کنید.');
    }

    public function completeRegistration(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'mobile' => ['required', 'string', 'max:20', 'unique:users,mobile'],
            'national_id' => ['required', 'string', 'size:10', 'regex:/^[0-9۰-۹]{10}$/', 'unique:users,national_id'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'national_id' => $data['national_id'],
                'password' => Hash::make($data['password']),
                'status' => 'active',
            ]);

            $role = Role::where('code', 'customer')->firstOrFail();
            $user->roles()->attach($role->id);
            $user->wallet()->create([
                'balance' => 0,
                'currency' => 'IRR',
            ]);

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('account.dashboard')->with('success', 'حساب شما با موفقیت ساخته شد.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
