<div x-data="{ open: false }" class="p-2 sm:p-4 lg:p-6">
    <div class="mb-5">
        <h2 class="text-2xl font-bold text-gray-800">Product Inventory</h2>
        <p class="text-sm text-gray-600">Manage your SKU, pricing, and stock levels.</p>
    </div>

    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    
                    <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                        <div class="relative max-w-xs">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" name="search" wire:model.live.debounce.300ms="search" id="search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Search products...">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </div>
                        </div>

                        <div class="inline-flex gap-x-2">
                            <button @click="open = true; $wire.create()"  class="py-2 px-5 inline-flex items-center text-sm font-bold rounded-xl border border-transparent bg-blue-600 text-white shadow-lg shadow-blue-200 hover:bg-blue-700 hover:shadow-none transition-all duration-200 transform active:scale-95">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                Add Product
                            </button>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">Product</th>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">SKU</th>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">Category</th>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">Stock (Qty)</th>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">Price</th>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">Status</th>
                                <th class="px-6 py-4 text-end"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                          @foreach ($products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-x-3">
                                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg">
                                        </div>
                                        <span class="text-sm font-medium text-gray-800">{{ $product->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $product->sku }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $product->category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $product->quantity . ' piece'}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{'$ ' . $product->price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="py-1 px-2 inline-flex items-center text-xs font-medium bg-green-100 text-green-800 rounded-full">In Stock</span>
                                </td>
                                <td class=" flex gap-x-3 justify-end px-8 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-800" wire:click="edit({{ $product->id}})" @click= "open = true"><i data-lucide="pencil" class="w-4 h-4 text-blue-600"></i>  </button>
                                    <button class="text-blue-600 hover:text-blue-800" wire:click="destory({{ $product->id}})"  wire:confirm="Are you sure you want to delete this product?"><i data-lucide="trash" class="w-4 h-4 text-red-600"></i></button>
                                </td>
                            </tr>
                            @endforeach
                    
                        </tbody>
                    </table>

                    <div class="px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                        <span class="text-sm text-gray-600">Showing 2 results</span>
                        <div class="inline-flex gap-x-2">
                            <button class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">Previous</button>
                            <button class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('livewire.pages.admin.partials.form-product')
</div>