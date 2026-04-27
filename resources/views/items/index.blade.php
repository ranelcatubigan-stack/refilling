<x-app-layout>
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h2 class="text-2xl font-bold mb-6">Item Management</h2>

                {{-- SUCCESS MESSAGE --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ADD ITEM FORM --}}
                <form method="POST" action="{{ route('items.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    @csrf

                    <!-- Item Name -->
                    <input type="text" name="item_name" placeholder="Item Name"
                        class="border p-2 rounded w-full" required>

                    <!-- Supplier SELECT -->
                    <select name="supplier_id" class="border p-2 rounded w-full" required>
                        <option value="">-- Select Supplier (Company) --</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">
                                {{ $supplier->supplier_name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Quantity -->
                    <input type="number" name="quantity" placeholder="Quantity"
                        class="border p-2 rounded w-full" required>


                    <!-- Description -->
                    <input type="text" name="description" placeholder="Description"
                        class="border p-2 rounded w-full">

                    <button type="submit">
                        Add Item
                    </button>
                </form>

                {{-- ITEM TABLE --}}
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 border">#</th>
                                <th class="p-2 border">Item Name</th>
                                <th class="p-2 border">Supplier</th>
                                <th class="p-2 border">Quantity</th>
                                <th class="p-2 border">Description</th>
                                <th class="p-2 border">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($items as $item)
                                <tr class="text-center">
                                    <td class="border p-2">{{ $item->id }}</td>
                                    <td class="border p-2">
                                        @if($item->item_name === 'Gallon')
                                            <span class="bg-blue-600 text-white px-2 py-1 rounded">
                                                {{ $item->item_name }} (STOCK ITEM)
                                            </span>
                                        @else
                                            {{ $item->item_name }}
                                        @endif
                                        @if($item->item_name === 'Gallon')
                                        <div class="text-xs text-green-600 font-bold">
                                            Used for Stock IN / OUT
                                        </div>
                                        @endif
                                    </td>
                                    <td class="border p-2">
                                        {{ $item->supplier->supplier_name ?? 'N/A' }}
                                    </td>
                                    <td class="border p-2">{{ $item->quantity }}</td>                                
                                    <td class="border p-2">{{ $item->description }}</td>

                                    <td class="border p-2 space-x-2">

                                        <!-- EDIT BUTTON -->
                                        <a href="{{ route('items.edit', $item->id) }}"
                                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>

                                        <!-- DELETE BUTTON -->
                                        @if($item->item_name === 'Gallon')
                                            <button disabled class="bg-gray-400 text-white px-3 py-1 rounded cursor-not-allowed">
                                                Locked
                                            </button>
                                        @else
                                            <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                                @csrf
                                                @method('DELETE')

                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                 Delete
                                            </button>
                                        </form>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-4 text-center text-gray-500">
                                        No items found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>