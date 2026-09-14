<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

        $mobile = trim((string) $request->input('mobile', ''));
        $nationalId = trim((string) $request->input('national_id', ''));

        // Normalize Persian/Arabic digits so visually identical values are stored consistently.
        $mobile = strtr($mobile, [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);
        $nationalId = strtr($nationalId, [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);

        $request->merge([
            'mobile' => $mobile,
            'national_id' => $nationalId,
        ]);

        $mobileRules = ['required', 'string', 'max:20'];
        if ($mobile !== (string) $user->mobile) {
            $mobileRules[] = Rule::unique('users', 'mobile')->ignore($user->id);
        }

        $nationalIdRules = ['required', 'string', 'size:10', 'regex:/^[0-9]{10}$/'];
        if ($nationalId !== (string) $user->national_id) {
            $nationalIdRules[] = Rule::unique('users', 'national_id')->ignore($user->id);
        }

        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'mobile' => $mobileRules,
            'national_id' => $nationalIdRules,
            'email' => [
                'nullable', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $update = [
            'name' => $data['name'] ?? null,
            'mobile' => $data['mobile'],
            'national_id' => $data['national_id'],
            'email' => $data['email'] ?? null,
        ];

        if (!empty($data['password'])) {
            $update['password'] = $data['password'];
        }

        $user->update($update);

        return back()->with('success', 'اطلاعات پروفایل با موفقیت ذخیره شد.');
    }
}
