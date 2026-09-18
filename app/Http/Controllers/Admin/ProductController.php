<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 1. عرض جدول كافة المنتجات
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // 2. صفحة إضافة منتج جديد
    public function create()
    {
        return view('admin.products.create');
    }

    // 3. حفظ منتج جديد
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'nullable|string|max:255',
            'title'       => 'nullable|string|max:255',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['name', 'title', 'price', 'description', 'status']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'تم إضافة المنتج بنجاح.');
    }

    // 4. عرض تفاصيل منتج معين
    public function show($id)
    {
        $product = Product::findOrFail($id);

        if (view()->exists('admin.products.show')) {
            return view('admin.products.show', compact('product'));
        }

        return redirect()->route('admin.products.edit', $id);
    }

    // 5. صفحة تعديل المنتج
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // 6. حفظ تعديلات المنتج
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => 'nullable|string|max:255',
            'title'       => 'nullable|string|max:255',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['name', 'title', 'price', 'description', 'status']);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'تم تحديث بيانات المنتج بنجاح.');
    }

    // 7. الموافقة على نشر المنتج
    public function approve($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => 'approved']);

        return back()->with('success', 'تم اعتماد نشر المنتج بنجاح.');
    }

    // 8. رفض نشر المنتج
    public function reject($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => 'rejected']);

        return back()->with('success', 'تم رفض نشر المنتج.');
    }

    // 9. حذف المنتج
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'تم حذف المنتج بنجاح.');
    }
}
