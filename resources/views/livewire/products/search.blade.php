<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Product;

new class extends Component {
    use WithPagination;
    public $search = '';
    public $perPage = 10;
     public function getSearchResults()
    {
         if($this->search =='')
        {
            return [];
        }
        $keywords = explode(' ', $this->search);
        $query = Product::query();
        foreach ($keywords as $keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }
       
        return $query->orderBy('created_at','DESC')->get();
    }
    public function with()
    {
        return ['products'=>$this->getSearchResults()];
       
    }
    
}; ?>

<div>
      <div class="w-full mt-12">
      @if (session('status'))
      <div id="alert" class="rounded-md p-4 bg-green-100 border-green-400 border">
    <div class="flex">
        <div class="flex-shrink-0">
            <!-- Heroicon name: exclamation -->
            <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-2a6 6 0 100-12 6 6 0 000 12zm-1-9a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1zm0 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm text-yellow-700">
                {{(session('status'))}}
            </p>
        </div>
        <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button id="dismissBtn" class="inline-flex rounded-md p-1.5 text-yellow-500 hover:bg-yellow-200 focus:outline-none focus:bg-yellow-200 transition ease-in-out duration-150">
                    <!-- Heroicon name: x -->
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M14.879 5.464a2 2 0 10-2.828-2.828L10 7.172 7.95 5.122a2 2 0 10-2.828 2.828L7.172 10l-2.05 2.05a2 2 0 102.828 2.828L10 12.828l2.05 2.05a2 2 0 102.828-2.828L12.828 10l2.051-2.05z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endif
    
                   <div class="flex justify mb-4">
                        <div class="relative">
                            <input type="text" wire:model='search' wire:keyup='getSearchResults' class="rounded-md border-gray-300 pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Search Products...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <!-- Heroicon name: search -->
                                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.414l3.862 3.862a1 1 0 11-1.414 1.414l-3.862-3.862zM8 14a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-auto">
                        <div class="container mx-auto px-4">
                        <p class="mb-2">Showing  {{count($products)}} Results</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            
                                @foreach($products as $product)
                                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                    <img class="w-full h-48 object-cover" src="{{ $product->image ? asset('storage/' . $product->image) : asset('storage/products/default.jpg') }}" alt="{{ $product->name }}">
                                    <div class="p-4">
                                        <h2 class="text-gray-900 font-bold text-xl mb-2">{{ $product->name }}</h2>
                                        <p class="text-gray-700 text-base">{{ number_format($product->price, 2) }}</p>
                                    </div>
                                </div>
                                @endforeach
                           
                            </div>
                    </div>

                       
                    </div>
                  
                </div>
    
</div>
<script>
    document.getElementById('dismissBtn').addEventListener('click', function() {
        document.getElementById('alert').style.display = 'none';
    });
</script>
