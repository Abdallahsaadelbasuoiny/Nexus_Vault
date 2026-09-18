<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('employe.index', compact('products'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'is_approved' => false,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة المنتج بنجاح، وهو بانتظار موافقة الأدمن!');
    }
}