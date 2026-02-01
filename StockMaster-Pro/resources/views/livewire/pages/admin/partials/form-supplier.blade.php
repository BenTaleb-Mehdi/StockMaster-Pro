    <div x-show="open" 
         class="fixed inset-0 z-[80] overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4" 
         style="display: none;"
         x-on:supplier-added.window="open = false"
         x-on:supplier-updated.window="open = false"
         x-transition>
        
        <div @click.away="open = false" class="bg-white border shadow-sm rounded-xl w-full max-w-2xl transform transition-all">
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                <h3 class="font-bold text-gray-800">{{ $isEditing ? 'Edit Supplier' : 'Create New Supplier' }}</h3>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <form wire:submit.prevent="save" class="space-y-5">
                   
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800">name</label>
                            <input type="text" wire:model="name" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:ring-blue-500 shadow-sm" placeholder="Enter a name supplier">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800">phone</label>
                            <input type="number" wire:model="phone" min="0" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:ring-blue-500 shadow-sm" placeholder="Enter a phone supplier">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800">address</label>
                            <textarea wire:model="address" min="5" class="py-2.5 px-4 block h-20 w-full border-gray-200 rounded-lg text-sm focus:ring-blue-500 shadow-sm" placeholder="Enter a address supplier"></textarea>
                        </div>
                    </div>



                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 mt-5">
                        <button @click="open = false; $wire.create()" type="button" class="py-2 px-3 text-sm font-medium text-gray-800 hover:bg-gray-50">Discard</button>
                        <button type="submit" class="py-2.5 px-6 inline-flex items-center text-sm font-bold rounded-xl bg-blue-600 text-white shadow-lg hover:bg-blue-700 transition-all active:scale-95">
                           <span wire:loading.remove wire:target="save">
                               {{ $isEditing ? 'Update Supplier' : 'Save Supplier' }}
                            </span>
                            <span wire:loading wire:target="save" class="animate-pulse italic">Processing...</span>
                        </button>
                    </div>
                </form>
            </div>

        
        </div>
    </div>