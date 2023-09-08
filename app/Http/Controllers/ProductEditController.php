<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductEditController extends Controller
{
    public function editProductPage(Product $product)
    {
        return view('admin.editProductPage', compact('product'));
    }

    
}
