<div x-data="{ open: false }" x-on:category-updated.window="open = false; $wire.create()" class="p-2 sm:p-4 lg:p-6">
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="border rounded-xl shadow-sm overflow-hidden bg-white border-gray-200">
<div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
  <div>
    <h2 class="text-xl font-semibold text-gray-800">Product Categories</h2>
    <p class="text-sm text-gray-600">Manage and organize your products into logical groups.</p>
  </div>

  <div class="inline-flex items-center gap-x-2">
    <div class="relative">
      <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
        <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
      </div>
      <input 
        type="text" 
        wire:model.live.debounce.300ms="search" 
        class="py-2 ps-10 pe-3 block w-full md:w-64 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none bg-white border" 
        placeholder="Search categories..."
      >
    </div>
<button @click="open = true; $wire.create()"  class="py-2 px-5 inline-flex items-center text-sm font-bold rounded-xl border border-transparent bg-blue-600 text-white shadow-lg shadow-blue-200 hover:bg-blue-700 hover:shadow-none transition-all duration-200 transform active:scale-95">
      <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
      Add Category
    </button>
  </div>
</div>

          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-start"><span class="text-xs font-semibold uppercase tracking-wide text-gray-800">Category Name</span></th>
                <th scope="col" class="px-6 py-3 text-start"><span class="text-xs font-semibold uppercase tracking-wide text-gray-800">Slug</span></th>
                <th scope="col" class="px-6 py-3 text-start"><span class="text-xs font-semibold uppercase tracking-wide text-gray-800">QTY Products</span></th>
                <th scope="col" class="px-6 py-4 text-end"></th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
              @foreach ($categories as $category)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-x-2">
                    <div class="size-7 flex justify-center items-center bg-gray-100 rounded-md">
                      <svg class="size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-800">{{ $category->name }} </span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap"><span class="text-xs font-mono text-gray-500">{{ $category->slug }}</span></td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">{{ $category->products_count . ' pieces' }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                  <button type="button" wire:click="edit({{ $category->id }})" @click="open = true" class="text-blue-600 hover:text-blue-800 font-semibold px-2"><i data-lucide="pencil" class="w-4 h-4 text-blue-600"></i></button>
                  <button type="button" wire:confirm="Are you sure you want to delete this category?" wire:click="delete({{ $category->id }})" class="text-red-600 hover:text-red-800 font-semibold px-2"><i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i></button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="px-6 py-4 border-t border-gray-200 flex justify-between items-center">
            <span class="text-sm text-gray-600">12 categories total</span>
            <nav class="flex items-center -space-x-px">
              <button class="py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm font-medium rounded-s-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50">Previous</button>
              <button class="py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm font-medium rounded-e-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50">Next</button>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div x-show="open" 
       class="fixed inset-0 z-[80] overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4" 
       style="display: none;"
       x-transition>
    
    <div @click.away="open = false" class="bg-white border shadow-sm rounded-xl w-full max-w-lg overflow-hidden transition-all">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 bg-gray-50">
        <h3 class="font-bold text-gray-800">Create New Category</h3>
        <button @click="open = false" class="text-gray-400 hover:text-gray-600">
          <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
      </div>

      <div class="p-4 sm:p-6 overflow-y-auto">
        <form class="space-y-4" wire:submit.prevent="save" id="category-form">
          <div>
            <label class="block text-sm font-medium mb-2 text-gray-800">Category Name</label>
            <input type="text" 
                   wire:model="name"
                   class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" 
                   placeholder="e.g. Home Appliances"
                   @input="$wire.set('slug', $event.target.value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, ''))">
             @error('name') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
          </div>

          <div>
            <label class="block text-sm font-medium mb-2 text-gray-800">URL Slug</label>
            <div class="flex rounded-lg shadow-sm">
              <span class="px-4 inline-flex items-center min-w-fit rounded-s-md border border-e-0 border-gray-200 bg-gray-50 text-sm text-gray-500">/</span>
              <input type="text" wire:model="slug" class="py-2.5 px-4 block w-full border-gray-200 shadow-sm rounded-e-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="home-appliances">
            </div>
            <p class="mt-2 text-xs text-gray-500">The "slug" is the URL-friendly version of the name.</p>
             @error('slug') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
          </div>

      
          <div>
            <label class="block text-sm font-medium mb-2 text-gray-800 uppercase italic">Category Image</label>
            
            <input type="file" wire:model="image" id="category-file-upload" class="sr-only">

            <div class="space-y-4">   
                <!-- Drop Zone -->
                <label for="category-file-upload" class="cursor-pointer p-12 flex justify-center bg-white border border-dashed border-gray-300 rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
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
                                        <span class="size-10 flex justify-end items-center bg-white border border-gray-200 text-gray-400 rounded-lg">
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

          <div>
            <label class="block text-sm font-medium mb-2 text-gray-800">Description <span class="text-gray-400 font-normal">(Optional)</span></label>
            <textarea wire:model="description" class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" rows="3" placeholder="Briefly describe the category..."></textarea>
             @error('description') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
          </div>
        </form>
         <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 bg-gray-50">
        <button @click="open = false; $wire.create()" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
          Cancel
        </button>
        <button type="submit" form="category-form" class="py-2 px-5 inline-flex items-center text-sm font-bold rounded-xl border border-transparent bg-blue-600 text-white shadow-lg shadow-blue-200 hover:bg-blue-700 hover:shadow-none transition-all duration-200 transform active:scale-95">
           <span wire:loading.remove wire:target="save">
              {{ $isEdit ? 'Update Changes' : 'Save Category' }}
           </span>
           <span wire:loading wire:target="save" class="animate-pulse italic">Processing...</span>
        </button>
      </div>
      </div>

     
      
    </div>
  </div>
</div>