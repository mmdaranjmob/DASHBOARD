<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StoreSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function home(Request $request): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order')])
            ->withCount(['products as active_products_count' => fn ($query) => $query->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();

        $selectedCategory = $categories->firstWhere('slug', $request->query('category')) ?? $categories->first();
        $tabs = $selectedCategory?->children ?? collect();
        $selectedTab = $tabs->firstWhere('slug', $request->query('tab')) ?? $tabs->first();

        $productQuery = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest();

        if ($selectedTab) {
            $productQuery->where('category_id', $selectedTab->id);
        } elseif ($selectedCategory) {
            $productQuery->where('category_id', $selectedCategory->id);
        } else {
            $productQuery->whereRaw('1 = 0');
        }

        $products = $productQuery->limit(30)->get();

        return view('store.home', [
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'tabs' => $tabs,
            'selectedTab' => $selectedTab,
            'products' => $products,
            'siteName' => StoreSetting::get('site_name', 'NumberLand'),
            'logoUrl' => StoreSetting::get('logo_url', ''),
            'bannerUrl' => StoreSetting::get('banner_url', ''),
            'bannerLink' => StoreSetting::get('banner_link', ''),
            'supportUrl' => StoreSetting::get('support_url', ''),
            'supportLabel' => StoreSetting::get('support_label', 'پشتیبانی'),
        ]);
    }

    public function product(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load(['category', 'fields.options']);

        return view('store.product', compact('product'));
    }
}
