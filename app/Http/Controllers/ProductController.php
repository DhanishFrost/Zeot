<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function adminProduct()
    {
        $products = Product::all();
        return view('admin.adminproduct', ['products' => $products]);
    }

    public function userProduct()
    {
        $products = Product::all();
        return view('users.product', compact('products'));
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required', // Adjust max file size as needed
        ]);


        $product = new Product();
        $product->name = $request->name;
        $product->description= $request->description;
        $product->price = $request->price;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images', $imageName);
            $product->image = $imageName;
        }
        $product->save();
        return response()->json(['message' => 'Product created successfully']);
    }

    public function editProduct($id)
    {
        $product = Product::where('id', '=', $id)->first();
        return view('admin.adminproduct', compact('product'));
    }

    public function updateProduct(Request $request)
    {
        $id = $request->id;
        $name = $request->editProductName;
        $description = $request->editProductDescription;
        $price = $request->editProductPrice;
        $image = $request->file('editProductImage');

        $product = Product::find($id);
        if ($product) {
            $product->name = $name;
            $product->description = $description;
            $product->price = $price;
            if ($image) {
                if
                ($product->image) {
                    Storage::delete('public/images/'.$product->image);
                }

                $imageName = $image->getClientOriginalName();
                $imagePath = $image->storeAs('public/images', $imageName);
                $product->image = $imageName;
            }
            $product->save();

            return response()->json(['message' => 'Product updated successfully']);
            
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function destroy($id)
{
    $product = Product::find($id);
    
    if ($product) {
        // Delete the associated image from storage
        if ($product->image) {
            Storage::delete('public/images/'.$product->image);
        }
        
        $product->delete();
        return redirect()->route('product.adminProduct')->with('success', 'Product deleted successfully.');
    }
    
    return redirect()->route('product.adminProduct')->with('error', 'Product not found.');
}

}
