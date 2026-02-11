<div x-data="{ open: false, openAdjuster: false }" class="p-2 sm:p-4 lg:p-6">
    <div class="mb-5">
        <h2 class="text-2xl font-bold text-gray-800">Product Inventory</h2>
        <p class="text-sm text-gray-600">Manage your SKU, pricing, and stock levels.</p>
    </div>

    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    
                    <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 w-full">
                        <div class="relative max-w-xs w-full">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" name="search" wire:model.live.debounce.300ms="search" id="search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Search products...">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2"> 
<div class="relative min-w-[160px]" 
     wire:ignore 
     x-data="{ 
        category: @entangle('selectedCategory'),
        resetFilter() {
            this.category = '';
            $wire.set('selectedCategory', ''); // Force server update
            const el = document.querySelector('#product-category-filter');
            if (window.HSSelect) {
                const instance = HSSelect.getInstance(el, true);
                if (instance) instance.setValue('');
            }
        }
     }">
    
    <select id="product-category-filter" data-hs-select='{
        "placeholder": "Category",
        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-4 pe-10 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500",
        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg shadow-xl overflow-hidden",
        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg",
        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2 flex items-center gap-1\"> <svg class=\"shrink-0 size-3.5 text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
    }' class="hidden" wire:model.live="selectedCategory" @change="category = $el.value">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <button type="button" 
            x-show="category" 
            @click="resetFilter()" 
            class="absolute top-1/2 end-8 -translate-y-1/2 text-gray-400 hover:text-red-500 z-20">
        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
    </button>
</div>
                            
                            <button @click="open = true; $wire.create()" class="py-2 px-5 inline-flex items-center text-sm font-bold rounded-xl border border-transparent bg-blue-600 text-white shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all duration-200 transform active:scale-95 whitespace-nowrap">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
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
                            <tr class="hover:bg-gray-50" wire:key="product-{{ $product->id }}">
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600" wire:poll.visible>{{ $product->quantity . ' piece'}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{'$ ' . $product->price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="py-1 px-2 inline-flex items-center text-xs font-medium bg-green-100 text-green-800 rounded-full">In Stock</span>
                                </td>
                                <td class="flex gap-x-3 justify-end px-8 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-800" wire:click="edit({{ $product->id}})" @click="open = true">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800"
                                            wire:click="$dispatch('swal:confirm', { title: 'Supprimer ce produit?', text: 'Cette action est irréversible', icon: 'warning', method: 'destroy', id: {{ $product->id }} })">
                                        <i data-lucide="trash" class="w-4 h-4"></i>
                                    </button>
                                    <button wire:click="$dispatch('openAdjustmentModal', { id: {{ $product->id }} })" @click="openAdjuster = true" class="text-yellow-600 hover:text-yellow-800" title="Ajuster le stock">
                                        <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                                    </button>
                                    <a href="{{ route('admin.product.report', $product->id) }}" target="_blank" class="text-blue-600 hover:text-blue-800" title="Générer le rapport">
                                        <i data-lucide="file-text" class="w-4 h-4"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                        <span class="text-sm text-gray-600">Showing {{ $products->count() }} results</span>
                        <div class="inline-flex gap-x-2">
                             {{ $products->links('livewire.pages.admin.partials.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.pages.admin.partials.form-product')
    <livewire:pages.admin.stock-adjuster />
</div>
