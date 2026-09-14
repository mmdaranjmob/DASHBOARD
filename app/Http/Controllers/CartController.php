<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);
        $products = Product::with('fields.options')
            ->whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        $items = collect($cart)->map(function ($item, $productId) use ($products) {
            $product = $products->get((int) $productId);
            if (!$product || !$product->is_active) {
                return null;
            }

            $quantity = max(1, min(20, (int) ($item['quantity'] ?? 1)));
            return [
                'product' => $product,
                'quantity' => $quantity,
                'fields' => $item['fields'] ?? [],
                'total' => $product->price * $quantity,
            ];
        })->filter()->values();

        $total = $items->sum('total');

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->is_active, 404);

        $data = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1', 'max:20'],
        ]);

        $cart = $request->session()->get('cart', []);
        $key = (string) $product->id;
        $current = (int) ($cart[$key]['quantity'] ?? 0);
        $cart[$key] = [
            'quantity' => min(20, max(1, $current + (int) ($data['quantity'] ?? 1))),
            'fields' => $cart[$key]['fields'] ?? [],
        ];
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'محصول به سبد خرید اضافه شد.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:20'],
        ]);

        $cart = $request->session()->get('cart', []);
        $key = (string) $product->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = (int) $data['quantity'];
            $request->session()->put('cart', $cart);
        }

        return back()->with('success', 'تعداد محصول بروزرسانی شد.');
    }

    public function remove(Request $request, Product $product): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[(string) $product->id]);
        $request->session()->put('cart', $cart);

        return back()->with('success', 'محصول از سبد خرید حذف شد.');
    }
}
