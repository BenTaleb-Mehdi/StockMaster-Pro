<div x-data="{ openAdjuster: @entangle('isOpen') }"
     x-show="openAdjuster"
     class="fixed inset-0 z-[80] overflow-y-auto min-h-screen "
     style="display: none;">
    
    <div x-show="openAdjuster" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm min-h-screen"></div>

    <div class="flex items-center justify-center min-h-screen p-4">
        <div x-show="openAdjuster"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             @click.away="openAdjuster = false"
             class="relative flex flex-col bg-white border shadow-sm rounded-xl w-full max-w-lg min-h-[500px]">
            
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                <h3 class="font-bold text-gray-800">
                    Stock Adjustment (Mise à jour)
                </h3>
                <button @click="openAdjuster = false" type="button" class="text-gray-400 hover:text-gray-600">
                    <span class="sr-only">Close</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form wire:submit.prevent="save" class="flex flex-col flex-1">
                <div class="p-6 flex-1">
                    <div class="space-y-5">
                        <div>
                            <label for="type" class="block text-sm font-medium mb-2 text-gray-800 uppercase italic">Type d'opération</label>
                            <div x-data="{ 
                                open: false, 
                                selected: '+ Addition (Restock/Retour)', 
                                type: @entangle('type'),
                                init() {
                                    if (this.type === 'subtraction') this.selected = '- Soustraction (Dommage/Perte)';
                                    this.$watch('type', value => {
                                        this.selected = value === 'addition' ? '+ Addition (Restock/Retour)' : '- Soustraction (Dommage/Perte)';
                                    });
                                }
                            }" class="relative">
                                <button type="button" @click="open = !open" 
                                    class="relative w-full text-start py-2.5 px-4 inline-flex justify-between items-center text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 focus:ring-2 focus:ring-blue-500/20 transition-all shadow-sm">
                                    <span x-text="selected"></span>
                                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="m6 9 6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>

                                <div x-show="open" 
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    @click.away="open = false" 
                                    class="absolute z-50 w-full mt-2 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden"
                                    style="display: none;">
                                    
                                    <div class="p-1">
                                        <button type="button" @click="selected = '+ Addition (Restock/Retour)'; $wire.set('type', 'addition'); open = false" 
                                            class="w-full text-left py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center justify-between group">
                                            + Addition (Restock/Retour)
                                            <span x-show="type === 'addition'" class="text-blue-600 font-bold">✓</span>
                                        </button>
                                        <button type="button" @click="selected = '- Soustraction (Dommage/Perte)'; $wire.set('type', 'subtraction'); open = false" 
                                            class="w-full text-left py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center justify-between group">
                                            - Soustraction (Dommage/Perte)
                                            <span x-show="type === 'subtraction'" class="text-blue-600 font-bold">✓</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @error('type') <p class="text-xs text-red-600 mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="quantity" class="block text-sm font-medium mb-2 text-gray-800 uppercase italic">Quantité</label>
                            <input type="number" wire:model="quantity" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" placeholder="0">
                            @error('quantity') <p class="text-xs text-red-600 mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="reason" class="block text-sm font-medium mb-2 text-gray-800 uppercase italic">Raison</label>
                            <div x-data="{ 
                                open: false, 
                                selected: 'Choisir une raison...', 
                                reason: @entangle('reason'),
                                options: {
                                    'restock': 'Nouvel Arrivage',
                                    'damaged': 'Produit Cassé/Endommagé',
                                    'return': 'Retour Client',
                                    'expired': 'Date Expirée',
                                    'correction': 'Correction d\'inventaire'
                                },
                                init() {
                                    if (this.reason && this.options[this.reason]) {
                                        this.selected = this.options[this.reason];
                                    }
                                    this.$watch('reason', value => {
                                        this.selected = this.options[value] || 'Choisir une raison...';
                                    });
                                }
                            }" class="relative">
                                <button type="button" @click="open = !open" 
                                    class="relative w-full text-start py-2.5 px-4 inline-flex justify-between items-center text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 focus:ring-2 focus:ring-blue-500/20 transition-all shadow-sm">
                                    <span x-text="selected"></span>
                                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="m6 9 6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>

                                <div x-show="open" 
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    @click.away="open = false" 
                                    class="absolute z-90 w-full mt-2 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden"
                                    style="display: none;">
                                    
                                    <div class="p-1">
                                        <template x-for="(label, key) in options" :key="key">
                                            <button type="button" @click="selected = label; $wire.set('reason', key); open = false" 
                                                class="w-full text-left py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center justify-between group">
                                                <span x-text="label"></span>
                                                <span x-show="reason === key" class="text-blue-600 font-bold">✓</span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            @error('reason') <p class="text-xs text-red-600 mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button @click="openAdjuster = false" type="button" class="py-2 px-3 text-sm font-medium text-gray-800 hover:bg-gray-50">
                        Annuler
                    </button>
                    <button type="submit" class="py-2.5 px-6 inline-flex items-center text-sm font-bold rounded-xl bg-blue-600 text-white shadow-lg hover:bg-blue-700 transition-all active:scale-95">
                        <span wire:loading.remove>Enregistrer</span>
                        <span wire:loading class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>