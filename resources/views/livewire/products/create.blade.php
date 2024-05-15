<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

new class extends Component {
    use withFileUploads;
    public $productName, $productImage, $productPrice;
   

    public function saveProduct()
    {
        $validated = $this->validate([
            'productName' => ['required', 'string', 'min:5'],
            'productPrice' => ['required'],
            'productImage' => 'nullable|image|max:1024', // 1MB Max
        ]);
        $imagePath = $this->productImage ? $this->productImage->store('products', 'public') : null;
        $formArray=['name'=>$this->productName,'image'=>$imagePath,'price'=>$this->productPrice];
        Product::create($formArray);
        session()->flash('status', 'Product successfully created.');
        $this->redirect(route('products.list', absolute: false), navigate: true);
    }


}; ?>

<div class="w-full mt-12">


    <form  class="space-y-4">
        <x-input wire:model="productName" label="Product Name" placeholder="Enter Product Name" />
        <x-input wire:model="productPrice" label="Product Price" placeholder="Enter Product Price" type="number" />
        <x-input wire:model="productImage" label="Product Image"  type="file"  />
        @if ($productImage) 
        <img  src="{{ $productImage->temporaryUrl() }}">
        @endif
       
        <div class="pt-4">
            <x-button  rose right-icon="calendar" wire:click='saveProduct' spinner>Save Now</x-button>
        </div>
      
    </form>
</div>

