<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function home(): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        $featuredProducts = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        $products = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest()
            ->limit(12)
            ->get();

        return view('store.home', compact('categories', 'featuredProducts', 'products'));
    }

    public function product(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load(['category', 'fields.options']);

        return view('store.product', compact('product'));
    }
}
