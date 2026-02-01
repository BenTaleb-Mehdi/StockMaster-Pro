    <div x-show="open" 
         class="fixed inset-0 z-[80] overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4" 
         style="display: none;"
         x-on:product-added.window="open = false"
         x-transition>
        
        <div @click.away="open = false" class="bg-white border shadow-sm rounded-xl w-full max-w-2xl transform transition-all">
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                <h3 class="font-bold text-gray-800">Create New Product</h3>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <form wire:submit.prevent="save" class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 uppercase italic">Product Name</label>
                            <input type="text" wire:model="name" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                            @error('name') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 uppercase italic">SKU</label>
                            <input type="text" wire:model="sku" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" placeholder="PRD-001">
                            @error('sku') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div x-data="{ 
                        selectOpen: false, 
                        search: '', 
                        selected: 'Select Category',
                        init() {
                            // Watcher bach ila tbeddel l-category f Livewire, Alpine i-7ess bih
                            this.$watch('selected', value => console.log(value));
                            if('{{ $isEdit }}' && '{{ $productSupplierName }}') {
                                this.selected = '{{ $productSupplierName }}';
                            }
                        }
                    }" 
                    x-effect="if('{{ $isEdit }}') { selected = '{{ $productSupplierName }}' }"
                    class="group">
                        
                        <label class="block text-sm font-medium mb-2 text-gray-800 uppercase italic">Supplier</label>
                        
                        <div class="relative">
                            <button type="button" @click="selectOpen = !selectOpen" 
                                class="relative w-full text-start py-2.5 px-4 inline-flex justify-between items-center text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 focus:ring-2 focus:ring-blue-500/20 transition-all">
                                
                                <span x-text="selected"></span>
                                
                                <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="selectOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="m6 9 6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>

                            <div x-show="selectOpen" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                @click.away="selectOpen = false" 
                                class="absolute z-50 w-full mt-2 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden">
                                
                                <div class="p-2 border-b border-gray-100 bg-gray-50/50">
                                    <input type="text" x-model="search" 
                                        class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" 
                                        placeholder="Search categories...">
                                </div>

                                <div class="p-1 max-h-44 overflow-y-auto scrollbar-thin">
                                    @isset($categories)
                                        @foreach($categories as $cat)
                                            <button type="button" 
                                                    x-show="'{{ strtolower($cat->name) }}'.includes(search.toLowerCase())"
                                                    @click="selected = '{{ $cat->name }}'; $wire.set('category_id', {{ $cat->id }}); selectOpen = false" 
                                                    class="w-full text-left py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center justify-between group">
                                                {{ $cat->name }}
                                                <span x-show="selected === '{{ $cat->name }}'" class="text-blue-600 font-bold">✓</span>
                                            </button>
                                        @endforeach
                                    @else
                                        <p class="text-xs text-gray-400 p-3 text-center italic">No categories found.</p>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ 
                        selectOpen: false, 
                        search: '', 
                        selected: 'Select Supplier',
                        init() {
                            // Watcher bach ila tbeddel l-category f Livewire, Alpine i-7ess bih
                            this.$watch('selected', value => console.log(value));
                            if('{{ $isEdit }}' && '{{ $productSupplierName }}') {
                                this.selected = '{{ $productSupplierName }}';
                            }
                        }
                    }" 
                    x-effect="if('{{ $isEdit }}') { selected = '{{ $productSupplierName }}' }"
                    class="group">
                        
                        <label class="block text-sm font-medium mb-2 text-gray-800 uppercase italic">Supplier</label>
                        
                        <div class="relative">
                            <button type="button" @click="selectOpen = !selectOpen" 
                                class="relative w-full text-start py-2.5 px-4 inline-flex justify-between items-center text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 focus:ring-2 focus:ring-blue-500/20 transition-all">
                                
                                <span x-text="selected"></span>
                                
                                <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="selectOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="m6 9 6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>

                            <div x-show="selectOpen" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                @click.away="selectOpen = false" 
                                class="absolute z-50 w-full mt-2 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden">
                                
                                <div class="p-2 border-b border-gray-100 bg-gray-50/50">
                                    <input type="text" x-model="search" 
                                        class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" 
                                        placeholder="Search suppliers...">
                                </div>

                                <div class="p-1 max-h-44 overflow-y-auto scrollbar-thin">
                                    @isset($suppliers)
                                        @foreach($suppliers as $supplier)
                                            <button type="button" 
                                                    x-show="'{{ strtolower($supplier->name) }}'.includes(search.toLowerCase())"
                                                    @click="selected = '{{ $supplier->name }}'; $wire.set('supplier_id', {{ $supplier->id }}); selectOpen = false" 
                                                    class="w-full text-left py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center justify-between group">
                                                {{ $supplier->name }}
                                                <span x-show="selected === '{{ $supplier->name }}'" class="text-blue-600 font-bold">✓</span>
                                            </button>
                                        @endforeach
                                    @else
                                        <p class="text-xs text-gray-400 p-3 text-center italic">No suppliers found.</p>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800">Price</label>
                            <input type="number" step="0.01" min="0" wire:model="price" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:ring-blue-500 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800">Quantity</label>
                            <input type="number" wire:model="quantity" min="0" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:ring-blue-500 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800">Min Stock</label>
                            <input type="number" wire:model="min_stock" min="5" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:ring-blue-500 shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-800 uppercase italic">Product Image</label>
                        
                        <input type="file" wire:model="image" id="file-upload" class="sr-only">

                        <div class="space-y-4">
                            <!-- Drop Zone -->
                            <label for="file-upload" class="cursor-pointer p-12 flex justify-center bg-white border border-dashed border-gray-300 rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                                <div class="text-center">
                                    <span class="inline-flex justify-center items-center size-16">
                                        <svg class="shrink-0 w-16 text-gray-400 mx-auto" width="73" height="47" viewBox="0 0 73 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M54.519 40.4773V6.76876C54.519 3.92686 52.2121 1.62305 49.3664 1.62305H22.7076C19.8619 1.62305 17.555 3.92686 17.555 6.76876V40.4773M54.519 40.4773C54.519 43.3192 52.2121 45.6231 49.3664 45.6231H22.7076C19.8619 45.6231 17.555 43.3192 17.555 40.4773M54.519 40.4773L54.5189 34.6563L48.6564 28.3566L43.2612 34.6373C42.4421 35.5908 40.9662 35.5955 40.141 34.6472L30.3406 23.3844L17.555 36.9154V40.4773M6.20483 9.59424L17.707 7.6798V42.5188L12.6457 43.5828C9.25658 44.2954 5.94238 42.0892 5.29702 38.691L1.14643 16.8357C0.500082 13.4322 2.78322 10.1637 6.20483 9.59424ZM65.8691 9.59424L54.3669 7.6798V42.5188L59.4282 43.5828C62.8173 44.2954 66.1316 42.0892 66.7769 38.691L70.9274 16.8357C71.5738 13.4322 69.2907 10.1637 65.8691 9.59424ZM45.0584 15.3561C45.0584 17.7228 43.1372 19.6413 40.7673 19.6413C38.3974 19.6413 36.4762 17.7228 36.4762 15.3561C36.4762 12.9894 38.3974 11.0708 40.7673 11.0708C43.1372 11.0708 45.0584 12.9894 45.0584 15.3561Z" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </span>

                                    <div class="mt-4 flex flex-wrap justify-center text-sm leading-6 text-gray-500">
                                        <span class="pe-1 font-medium text-gray-800">
                                            Drop your file here or
                                        </span>
                                        <span class="font-semibold text-blue-600 hover:text-blue-700 rounded-lg decoration-2 hover:underline focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2">browse</span>
                                    </div>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Pick a file up to 2MB.
                                    </p>
                                </div>
                            </label>

                            <!-- Preview / Feedback -->
                            @if ($image)
                                <div class="p-3 bg-white border border-gray-200 rounded-xl">
                                    <div class="mb-1 flex justify-between items-center">
                                        <div class="flex items-center gap-x-3">
                                            <span class="size-10 flex justify-center items-center bg-gray-100 border border-gray-200 text-gray-400 rounded-lg">
                                                <img src="{{ $image->temporaryUrl() }}" class="rounded-lg max-h-full max-w-full object-cover">
                                            </span>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">
                                                    <span class="truncate inline-block max-w-[200px] align-bottom">New Image Selected</span>
                                                </p>
                                                <p class="text-xs text-blue-600 font-medium">Ready to upload</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-x-2">
                                            <button type="button" wire:click="$set('image', null)" class="text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-x-3 whitespace-nowrap">
                                        <div class="flex w-full h-2 bg-gray-100 rounded-full overflow-hidden" role="progressbar">
                                            <div class="flex flex-col justify-center rounded-full overflow-hidden bg-green-500 text-xs text-white text-center whitespace-nowrap transition-all duration-500" style="width: 100%"></div>
                                        </div>
                                        <div class="w-10 text-end">
                                            <span class="text-sm text-gray-800">100%</span>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($isEdit && $currentImagePath)
                                <div class="p-3 bg-gray-50 border border-gray-200 rounded-xl relative group">
                                     <div class="flex items-center gap-x-3">
                                        <span class=" flex justify-end items-center bg-white border border-gray-200 text-gray-400 rounded-lg">
                                            <img src="{{ asset('storage/' . $currentImagePath) }}" class="rounded-lg max-h-full max-w-full object-cover">
                                        </span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">
                                                Current Image
                                            </p>
                                            <p class="text-xs text-gray-500">Saved</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                             <div wire:loading wire:target="image" class="w-full text-center mt-2">
                                <span class="text-sm text-blue-600 font-semibold animate-pulse">Uploading Image...</span>
                            </div>
                        </div>
                        
                        @error('image') <span class="text-red-500 text-xs mt-2 block font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 mt-5">
                        <button @click="open = false; $wire.create()" type="button" class="py-2 px-3 text-sm font-medium text-gray-800 hover:bg-gray-50">Discard</button>
                        <button type="submit" class="py-2.5 px-6 inline-flex items-center text-sm font-bold rounded-xl bg-blue-600 text-white shadow-lg hover:bg-blue-700 transition-all active:scale-95">
                           <span wire:loading.remove wire:target="save">
                                {{ $isEdit ? 'Update Changes' : 'Save Product' }}
                            </span>
                            <span wire:loading wire:target="save" class="animate-pulse italic">Processing...</span>
                        </button>
                    </div>
                </form>
            </div>

        
        </div>
    </div>