<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    public function store(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->is_active, 404);

        $product->load('fields.options');

        $rules = [
            'quantity' => ['nullable', 'integer', 'min:1', 'max:20'],
            'idempotency_key' => ['required', 'uuid'],
        ];

        foreach ($product->fields as $field) {
            $fieldRules = [$field->is_required ? 'required' : 'nullable', 'string', 'max:1000'];
            if ($field->type === 'select') {
                $allowed = $field->options->pluck('value')->all();
                $fieldRules[] = function ($attribute, $value, $fail) use ($allowed) {
                    if (!in_array($value, $allowed, true)) {
                        $fail('مقدار انتخاب‌شده معتبر نیست.');
                    }
                };
            }
            $rules['fields.' . $field->key] = $fieldRules;
        }

        $data = $request->validate($rules);
        $quantity = (int) ($data['quantity'] ?? 1);
        $total = (int) $product->price * $quantity;

        try {
            $order = DB::transaction(function () use ($request, $product, $data, $quantity, $total) {
                $existing = Order::where('user_id', $request->user()->id)
                    ->where('customer_note', 'idempotency:' . $data['idempotency_key'])
                    ->first();

                if ($existing) {
                    return $existing;
                }

                $wallet = $request->user()->wallet()->lockForUpdate()->first();
                if (!$wallet) {
                    $wallet = $request->user()->wallet()->create(['balance' => 0, 'currency' => 'IRR']);
                }

                if ((int) $wallet->balance < $total) {
                    abort(422, 'موجودی کیف پول کافی نیست.');
                }

                if ($product->has_inventory) {
                    $lockedProduct = Product::whereKey($product->id)->lockForUpdate()->firstOrFail();
                    if ((int) $lockedProduct->inventory < $quantity) {
                        abort(422, 'موجودی محصول کافی نیست.');
                    }
                    $lockedProduct->decrement('inventory', $quantity);
                }

                $before = (int) $wallet->balance;
                $after = $before - $total;
                $wallet->update(['balance' => $after]);

                $order = Order::create([
                    'order_number' => 'DB-' . now()->format('ymdHis') . '-' . Str::upper(Str::random(5)),
                    'user_id' => $request->user()->id,
                    'subtotal' => $total,
                    'discount_amount' => 0,
                    'total_amount' => $total,
                    'currency' => $product->currency,
                    'status' => $product->delivery_type === 'automatic' ? 'processing' : 'pending',
                    'customer_note' => 'idempotency:' . $data['idempotency_key'],
                    'paid_at' => now(),
                ]);

                $item = $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_price' => $product->price,
                    'quantity' => $quantity,
                    'total_price' => $total,
                    'delivery_data' => $product->delivery_config,
                    'status' => $product->delivery_type === 'automatic' ? 'processing' : 'pending',
                ]);

                foreach ($product->fields as $field) {
                    $value = $data['fields'][$field->key] ?? null;
                    if ($value !== null && $value !== '') {
                        DB::table('order_field_values')->insert([
                            'order_item_id' => $item->id,
                            'product_field_id' => $field->id,
                            'value' => $value,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }

                $wallet->transactions()->create([
                    'type' => 'purchase',
                    'amount' => $total,
                    'balance_before' => $before,
                    'balance_after' => $after,
                    'currency' => $wallet->currency,
                    'status' => 'completed',
                    'description' => 'خرید ' . $product->name,
                    'idempotency_key' => $data['idempotency_key'],
                    'reference_type' => Order::class,
                    'reference_id' => $order->id,
                ]);

                return $order;
            });
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            return back()->withErrors(['purchase' => $e->getMessage()])->withInput();
        }

        return redirect()->route('account.orders.show', $order)->with('success', 'سفارش با موفقیت ثبت شد.');
    }
}
