<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination; // Correct import for pagination
use App\Models\Product;

class Products extends Component
{
    use WithFileUploads, WithPagination; // Apply the trait

    public $image;
    public $existingImage;
    public $product_id;
    public $name = '';
    public $description = '';
    public $isEdit = false;
    public $title = 'Add New Product';

    protected $paginationTheme = 'bootstrap'; // Optional: Bootstrap pagination theme

    public function resetFields()
    {
        $this->title = 'Add New Product';
        $this->reset('name', 'description', 'image', 'existingImage');
        $this->isEdit = false;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Changed to nullable to allow updating without an image
        ]);

        $imagePath = $this->existingImage;

        if ($this->image && $this->image instanceof \Illuminate\Http\UploadedFile) {
            $imagePath = $this->image->store('images', 'public');
        }

        Product::updateOrCreate(['id' => $this->product_id], [
            'name' => $this->name,
            'image' => $imagePath,
            'description' => $this->description,
        ]);

        session()->flash('message', $this->product_id ? 'Product is updated.' : 'Product is added.');

        $this->resetFields();
    }

    public function edit($id)
    {
        $this->title = 'Edit Product';

        $product = Product::findOrFail($id);

        $this->product_id = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->existingImage = $product->image;
        $this->isEdit = true;
    }

    public function cancel()
    {
        $this->resetFields();
    }

    public function delete($id)
    {
        Product::find($id)->delete();

        session()->flash('error', 'Product is deleted.');
    }

    public function render()
    {
        return view('livewire.products', [
            'products' => Product::latest()->paginate(5) // Paginate with 5 products per page
        ]);
    }
}
