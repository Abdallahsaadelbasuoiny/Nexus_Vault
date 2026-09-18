<?php

namespace App\Http\Controllers;

use App\Models\Product;

class EmployeeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('employee.dashboard', compact('products'));
    }
}