<div class="p-2 sm:p-4 lg:p-6">
    <div class="mb-5">
        <h2 class="text-2xl font-bold text-gray-800">Historique des Mouvements</h2>
        <p class="text-sm text-gray-600">Suivi des entrées et sorties de stock.</p>
    </div>

    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    
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
                        {{ $history->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>