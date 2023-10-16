<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Product;
use Livewire\Livewire;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;
    public $product;
    public $name;
    public $description;
    public $brand;
    public $category;
    public $quantity;
    public $price;
    public $image;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->brand = $product->brand;
        $this->category = $product->category;
        $this->quantity = $product->quantity;
        $this->price = $product->price;

    }

    public function updateProduct()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);
        dd($this->image);
        if ($this->image) {
            // Upload and update image
            $imageName = $this->image->getClientOriginalName();
            $imagePath = $this->image->storeAs('public/images', $imageName);

            if ($this->product->image) {
                Storage::delete('public/images/' . $this->product->image);
            }

            $this->product->image = $imageName;
        }

        $this->product->name = $this->name;
        $this->product->description = $this->description;
        $this->product->brand = $this->brand;
        $this->product->category = $this->category;
        $this->product->quantity = $this->quantity;
        $this->product->price = $this->price;
        $this->product->save();
        
        session()->flash('success', 'Product updated successfully.');

        return redirect()->route('product.adminProduct');
    }

    

    public function render()
    {
        return view('livewire.edit-product');
    }
}
