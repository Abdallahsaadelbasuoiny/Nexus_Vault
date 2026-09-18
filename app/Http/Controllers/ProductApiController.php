<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get()->map(function ($product) {
            return [
                'id'             => $product->id,
                'name'           => $product->name,
                'productName'    => $product->name,
                'price'          => $product->price,
                'productPrice'   => $product->price,
                'image'          => $product->image,
                'photo'          => $product->image,
                'description'    => $product->description,
                'productionDate' => $product->created_at ? $product->created_at->format('Y-m-d') : null,
            ];
        });

        // إرجاع المصفوفة مباشرة (أحياناً الواجهة لا تقرأ response.data)
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'price'       => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'image'       => ['required', 'mimes:png,jpg,bmp'],
        ]);

        $folder = 'productsPhotos/';
        $photo = $request->file('image');
        $photoName = time() . $photo->getClientOriginalName();
        $photo->move(public_path($folder), $photoName);

        $product = new Product();
        $product->name        = $request->name;
        $product->price       = $request->price;
        $product->description = $request->description;
        $product->image       = $photoName;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully.',
            'data'    => $product,
        ], 201);
    }

    public function show(Product $product)
    {
        return response()->json([
            'success' => true,
            'data'    => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'price'       => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'mimes:png,jpg,bmp'],
        ]);

        $product->name        = $request->name;
        $product->price       = $request->price;
        $product->description = $request->description;

        $folder = 'productsPhotos/';

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($folder . $product->image))) {
                unlink(public_path($folder) . $product->image);
            }

            $photo = $request->file('image');
            $photoName = time() . $photo->getClientOriginalName();
            $photo->move(public_path($folder), $photoName);
            $product->image = $photoName;
        }

        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully.',
            'data'    => $product,
        ]);
    }

    public function destroy(Product $product)
    {
        $folder = 'productsPhotos/';
        if ($product->image && file_exists(public_path($folder . $product->image))) {
            unlink(public_path($folder) . $product->image);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.',
        ]);
    }
}
