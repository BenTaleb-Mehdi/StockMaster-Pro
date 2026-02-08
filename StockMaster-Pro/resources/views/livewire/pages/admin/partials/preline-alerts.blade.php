<div x-data="{ 
    showConfirm: false,
    showSuccess: false,
    title: '',
    text: '',
    method: '',
    id: null,
    type: 'success',

    init() {
        window.addEventListener('swal:confirm', event => {
            const data = Array.isArray(event.detail) ? event.detail[0] : event.detail;
            this.title = data.title || 'Êtes-vous sûr?';
            this.text = data.text || 'Cette action est irréversible.';
            this.method = data.method;
            this.id = data.id;
            this.showConfirm = true;
        });

        window.addEventListener('swal:modal', event => {
            const data = Array.isArray(event.detail) ? event.detail[0] : event.detail;
            this.title = data.title;
            this.text = data.text;
            this.type = data.type || 'success';
            this.showSuccess = true;
        });
    },

    confirm() {
        Livewire.dispatch(this.method, { id: this.id });
        this.showConfirm = false;
    }
}" x-cloak>

    <!-- Confirmation Modal -->
    <div x-show="showConfirm" 
         class="fixed inset-0 z-[100] overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="bg-white border shadow-sm rounded-xl w-full max-w-md overflow-hidden transition-all transform"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="p-4 sm:p-7 text-center">
                <!-- Icon -->
                <div class="mx-auto flex items-center justify-center size-12 rounded-full bg-red-100 mb-4">
                    <svg class="shrink-0 size-5 text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-800" x-text="title"></h3>
                <p class="mt-2 text-gray-600" x-text="text"></p>

                <div class="mt-8 flex justify-center gap-x-2">
                    <button @click="showConfirm = false" type="button" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none text-nowrap">
                        Annuler
                    </button>
                    <button @click="confirm()" type="button" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none text-nowrap">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div x-show="showSuccess" 
         class="fixed inset-0 z-[100] overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="bg-white border shadow-sm rounded-xl w-full max-w-md overflow-hidden transition-all transform"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="p-4 sm:p-7 text-center">
                <!-- Icon -->
                <div class="mx-auto flex items-center justify-center size-12 rounded-full bg-green-100 mb-4">
                    <svg class="shrink-0 size-5 text-green-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-800" x-text="title"></h3>
                <p class="mt-2 text-gray-600" x-text="text"></p>

                <div class="mt-8 flex justify-center">
                    <button @click="showSuccess = false" type="button" class="w-full py-2.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        D'accord
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
