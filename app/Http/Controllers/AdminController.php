<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{
    private function authorizeAdmin(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);
    }

    public function dashboard(): View
    {
        $this->authorizeAdmin();
        $stats = [
            'users' => User::count(),
            'orders' => Order::count(),
            'pending_orders' => Order::whereIn('status', ['pending', 'processing'])->count(),
            'revenue' => Order::whereIn('status', ['paid', 'processing', 'completed'])->sum('total_amount'),
        ];
        $latestOrders = Order::with('user')->latest()->limit(10)->get();
        return view('admin.dashboard', compact('stats', 'latestOrders'));
    }

    public function users(Request $request): View
    {
        $this->authorizeAdmin();
        $query = User::with('roles')->latest();
        if ($search = trim((string) $request->query('q'))) {
            $query->where(fn ($q) => $q->where('mobile', 'like', "%{$search}%")
                ->orWhere('national_id', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%"));
        }
        return view('admin.users', ['users' => $query->paginate(20)->withQueryString()]);
    }

    public function products(): View
    {
        $this->authorizeAdmin();
        return view('admin.products', ['products' => Product::with('category')->orderBy('sort_order')->latest()->paginate(20)]);
    }

    public function productCreate(): View
    {
        $this->authorizeAdmin();
        return view('admin.product-form', ['product' => null, 'categories' => Category::orderBy('name')->get()]);
    }

    public function productStore(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();
        $data = $this->validateProduct($request);
        Product::create($data);
        return redirect()->route('admin.products')->with('success', 'محصول ایجاد شد.');
    }

    public function productEdit(Product $product): View
    {
        $this->authorizeAdmin();
        return view('admin.product-form', ['product' => $product, 'categories' => Category::orderBy('name')->get()]);
    }

    public function productUpdate(Request $request, Product $product): RedirectResponse
    {
        $this->authorizeAdmin();
        $data = $this->validateProduct($request, $product->id);
        $product->update($data);
        return redirect()->route('admin.products')->with('success', 'محصول ویرایش شد.');
    }

    public function productToggle(Product $product): RedirectResponse
    {
        $this->authorizeAdmin();
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', 'وضعیت محصول تغییر کرد.');
    }

    public function categories(): View
    {
        $this->authorizeAdmin();
        return view('admin.categories', ['categories' => Category::withCount('products')->orderBy('sort_order')->get()]);
    }

    public function categoryStore(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug'],
            'description' => ['nullable', 'string'],
        ]);
        Category::create($data + ['is_active' => true]);
        return back()->with('success', 'دسته‌بندی ایجاد شد.');
    }

    public function orders(Request $request): View
    {
        $this->authorizeAdmin();
        $query = Order::with(['user', 'items'])->latest();
        if ($status = $request->query('status')) $query->where('status', $status);
        return view('admin.orders', ['orders' => $query->paginate(20)->withQueryString()]);
    }

    public function orderUpdate(Request $request, Order $order): RedirectResponse
    {
        $this->authorizeAdmin();
        $data = $request->validate([
            'status' => ['required', 'in:pending,paid,processing,completed,cancelled,refunded'],
            'admin_note' => ['nullable', 'string', 'max:5000'],
        ]);
        $order->update($data + [
            'paid_at' => $data['status'] === 'paid' ? ($order->paid_at ?: now()) : $order->paid_at,
            'completed_at' => $data['status'] === 'completed' ? ($order->completed_at ?: now()) : $order->completed_at,
        ]);
        return back()->with('success', 'سفارش بروزرسانی شد.');
    }

    public function manualCredit(Request $request, User $user): RedirectResponse
    {
        $this->authorizeAdmin();
        $data = $request->validate(['amount' => ['required', 'integer', 'min:1'], 'description' => ['nullable', 'string', 'max:255']]);
        DB::transaction(function () use ($data, $user) {
            $wallet = $user->wallet()->lockForUpdate()->firstOrCreate([], ['balance' => 0, 'currency' => 'IRR']);
            $before = (int) $wallet->balance;
            $after = $before + (int) $data['amount'];
            $wallet->update(['balance' => $after]);
            WalletTransaction::create([
                'wallet_id' => $wallet->id, 'type' => 'admin_credit', 'amount' => $data['amount'],
                'balance_before' => $before, 'balance_after' => $after, 'currency' => $wallet->currency,
                'status' => 'completed', 'description' => $data['description'] ?? 'شارژ دستی توسط مدیر',
            ]);
        });
        return back()->with('success', 'کیف پول مشتری شارژ شد.');
    }

    private function validateProduct(Request $request, ?int $ignoreId = null): array
    {
        $uniqueSlug = 'unique:products,slug'.($ignoreId ? ",{$ignoreId}" : '');
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', $uniqueSlug],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'old_price' => ['nullable', 'integer', 'min:0'],
            'currency' => ['required', 'string', 'max:10'],
            'delivery_type' => ['required', 'in:automatic,manual'],
            'delivery_minutes' => ['nullable', 'integer', 'min:0'],
            'has_inventory' => ['boolean'],
            'inventory' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]) + [
            'has_inventory' => $request->boolean('has_inventory'),
            'is_active' => $request->boolean('is_active'),
            'is_featured' => $request->boolean('is_featured'),
        ];
    }
}
