<div class="p-2 sm:p-4 lg:p-6">
    <div class="mb-5">
        <h2 class="text-2xl font-bold text-gray-800">Historique des Mouvements</h2>
        <p class="text-sm text-gray-600">Suivi des entrées et sorties de stock.</p>
    </div>

    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    
                    <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                        <div class="relative max-w-xs w-full">
                            <label for="stock-history-search" class="sr-only">Chercher</label>
                            <input type="text" name="stock-history-search" wire:model.live.debounce.300ms="search" id="stock-history-search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Chercher un mouvement...">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                             <div class="relative min-w-[200px]" 
                                 wire:ignore 
                                 x-data="{ 
                                    category: @entangle('selectedCategory'),
                                    resetFilter() {
                                        this.category = '';
                                        $wire.set('selectedCategory', ''); // Force server update
                                        const el = document.querySelector('#stock-category-filter');
                                        if (window.HSSelect) {
                                            const instance = HSSelect.getInstance(el, true);
                                            if (instance) instance.setValue('');
                                        }
                                    }
                                 }">
                                
                                <select id="stock-category-filter" data-hs-select='{
                                    "placeholder": "Filtrer par Catégorie",
                                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-4 pe-10 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500",
                                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg shadow-xl overflow-hidden",
                                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg",
                                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2 flex items-center gap-1\"> <svg class=\"shrink-0 size-3.5 text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                }' class="hidden" wire:model.live="selectedCategory" @change="category = $el.value">
                                    <option value="">Toutes les catégories</option>
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
                        </div>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">Produit</th>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">Manager</th>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">Action</th>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">Quantité</th>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">Raison</th>
                                <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-500">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($history as $adj)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-800">{{ $adj->product->name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $adj->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="py-1 px-2 inline-flex items-center text-xs font-medium rounded-full {{ $adj->type === 'addition' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $adj->type === 'addition' ? '+ Entrée' : '- Sortie' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $adj->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm italic text-gray-500">{{ $adj->reason }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $adj->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $history->links('livewire.pages.admin.partials.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>