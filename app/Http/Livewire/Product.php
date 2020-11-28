<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Storage;

class Product extends Component
{
    use WithFileUploads;

    public $name, $image, $description, $qty, $price;

    public function render()
    {
        $products = ProductModel::orderBy('created_at', 'DESC')->get();
        return view('livewire.product', compact('products'));
    }

    public function store()
    {
      $this->validate([
        'name' => 'required',
        'image' => 'image|max:2048|required',
        'description' => 'required',
        'qty' => 'required',
        'price' => 'required',
      ]);

      $imageName = md5($this->image.microtime().".".$this->image->extension());
      Storage::putFileAs('public/images', $this->image, $imageName);

      ProductModel::create([
        'name' => $this->name,
        'image' => $imageName,
        'description' => $this->description,
        'qty' => $this->qty,
        'price' => $this->price
      ]);

      session()->flash('info', 'Produk Berhasil Ditambahkan');

      $this->name = '';
      $this->description = '';
      $this->image = '';
      $this->qty = '';
      $this->price = '';
    }
}
