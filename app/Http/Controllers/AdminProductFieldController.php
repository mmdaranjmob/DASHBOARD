<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductField;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminProductFieldController extends Controller
{
    private function authorizeAdmin(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        $this->authorizeAdmin();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'key' => [
                'required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9_]+$/',
                Rule::unique('product_fields', 'key')->where(fn ($query) => $query->where('product_id', $product->id)),
            ],
            'type' => ['required', 'in:text,number,textarea,select'],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_required' => ['boolean'],
            'options' => ['nullable', 'string', 'max:5000'],
        ]);

        $field = $product->fields()->create([
            'name' => $data['name'], 'key' => $data['key'], 'type' => $data['type'],
            'description' => $data['description'] ?? null, 'is_required' => $request->boolean('is_required'),
            'is_active' => true, 'sort_order' => $data['sort_order'] ?? 0,
        ]);

        if ($field->type === 'select' && !empty($data['options'])) {
            foreach (preg_split('/\r?\n/', trim($data['options'])) as $i => $line) {
                $line = trim($line);
                if ($line === '') continue;
                $parts = array_map('trim', explode('|', $line, 2));
                $field->options()->create([
                    'label' => $parts[0], 'value' => $parts[1] ?? $parts[0],
                    'sort_order' => $i, 'is_active' => true,
                ]);
            }
        }

        return back()->with('success', 'فیلد محصول اضافه شد.');
    }

    public function destroy(ProductField $field): RedirectResponse
    {
        $this->authorizeAdmin();
        $field->delete();
        return back()->with('success', 'فیلد محصول حذف شد.');
    }
}
