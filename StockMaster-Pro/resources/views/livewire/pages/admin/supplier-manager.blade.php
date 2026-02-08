<div x-data="{ open: false }" class="p-2 sm:p-4 lg:p-6">
    
    <div class="mb-5">
        <h2 class="text-2xl font-bold text-gray-800">Supplier Management</h2>
        <p class="text-sm text-gray-600">Filter suppliers by categories.</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
            
            <div class="relative max-w-xs w-full">
                <input type="text" wire:model.live.debounce.300ms="search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500" placeholder="Search suppliers...">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <div class="relative min-w-[200px]" wire:ignore>
                    <div x-data="{ 
                        category: @entangle('selectedCategory'),
                        resetFilter() {
                            this.category = '';
                            $wire.set('selectedCategory', ''); // Force server update
                            const el = document.querySelector('#supplier-category-filter');
                            if (window.HSSelect) {
                                const instance = HSSelect.getInstance(el, true);
                                if (instance) instance.setValue('');
                            }
                        }
                    }">
                        <select id="supplier-category-filter" data-hs-select='{
                            "placeholder": "Filter by Category",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-4 pe-12 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500",
                            "dropdownClasses": "mt-2 z-[70] w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg shadow-xl overflow-hidden",
                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg"
                        }' class="hidden" wire:model.live="selectedCategory" @change="category = $el.value">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>

                        <button type="button" 
                                x-show="category && category != ''" 
                                @click="resetFilter()" 
                                class="absolute top-1/2 end-10 -translate-y-1/2 text-gray-400 hover:text-red-500 z-[80] flex items-center justify-center pointer-events-auto">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        
                        <div class="absolute top-1/2 end-3 -translate-y-1/2 pointer-events-none">
                            <svg class="size-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m7 15 5 5 5-5M7 9l5-5 5 5"/></svg>
                        </div>
                    </div>
                </div>

                <button @click="open = true; $wire.create()" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    Add Supplier
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Supplier</th>
                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Phone</th>
                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Address</th>
                        <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($suppliers as $supplier)
                        <tr wire:key="sup-{{ $supplier->id }}">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $supplier->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $supplier->phone }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $supplier->address }}</td>
                            <td class="px-6 py-4 text-end text-sm font-medium">
                                <button wire:click="edit({{ $supplier->id }})" @click="open = true" class="text-blue-600 hover:text-blue-900 mr-3"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                <button class="text-red-600 hover:text-red-900"
                                        wire:click="$dispatch('swal:confirm', { title: 'Supprimer ce fournisseur?', text: 'Cette action est irréversible', icon: 'warning', method: 'destroy', id: {{ $supplier->id }} })">
                                    <i data-lucide="trash" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-500">No suppliers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $suppliers->links('livewire.pages.admin.partials.pagination') }}
        </div>
    </div>

    @include('livewire.pages.admin.partials.form-supplier')
</div>