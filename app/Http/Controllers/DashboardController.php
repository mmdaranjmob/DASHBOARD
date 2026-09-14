<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user()->loadMissing('wallet');
        $orders = $user->orders()->with('items')->latest()->limit(5)->get();

        return view('dashboard.index', compact('user', 'orders'));
    }

    public function transactions(Request $request): View
    {
        $user = $request->user()->loadMissing('wallet');
        $transactions = $user->wallet
            ? $user->wallet->transactions()->latest()->paginate(15)
            : collect();

        return view('dashboard.transactions', compact('user', 'transactions'));
    }

    public function profile(Request $request): View
    {
        return view('dashboard.profile', ['user' => $request->user()]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:20', 'unique:users,mobile,' . $user->id],
            'national_id' => ['required', 'string', 'size:10', 'regex:/^[0-9۰-۹]{10}$/', 'unique:users,national_id,' . $user->id],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($data);

        return back()->with('success', 'اطلاعات پروفایل با موفقیت ذخیره شد.');
    }
}
