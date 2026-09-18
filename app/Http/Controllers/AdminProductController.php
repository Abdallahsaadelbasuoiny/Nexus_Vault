<?php

namespace App\Http\Controllers;

use App\Models\Product; // قم بتعديله لـ ResaleListing أو اسم الموديل المستعمل لديك
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['status'] = 'approved'; // المنتجات المضافة بواسطة الأدمن تُعتمد مباشرة

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة في الـ Storage
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'تم تحديث بيانات المنتج');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'تم حذف المنتج بنجاح');
    }

    public function approve($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => 'approved']);

        return back()->with('success', 'تمت الموافقة على نشر المنتج');
    }

    public function reject($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => 'rejected']);

        return back()->with('success', 'تم رفض المنتج');
    }
}
