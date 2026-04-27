<x-app-layout>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h2 class="text-2xl font-bold mb-6">Edit Item</h2>

                {{-- ERROR MESSAGES --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- EDIT FORM --}}
                <form method="POST" action="{{ route('items.update', $item->id) }}" class="grid grid-cols-1 gap-4">
                    @csrf
                    @method('PUT')

                    <!-- Item Name -->
                    <input type="text" name="item_name"
                        value="{{ $item->item_name }}"
                        class="border p-2 rounded w-full"
                        placeholder="Item Name"
                        required>

                    <!-- Supplier SELECT -->
                    <select name="supplier_id" class="border p-2 rounded w-full" required>
                        <option value="">-- Select Supplier --</option>

                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                {{ $item->supplier_id == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->supplier_name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Quantity -->
                    <input type="number" name="quantity"
                        value="{{ $item->quantity }}"
                        class="border p-2 rounded w-full"
                        placeholder="Quantity"
                        required>

                    <!-- Description -->
                    <input type="text" name="description"
                        value="{{ $item->description }}"
                        class="border p-2 rounded w-full"
                        placeholder="Description">

                    <!-- Buttons -->
                    <div class="flex gap-3 mt-4">
                        <button type="submit">
                            Update Item
                        </button>

                        <a href="{{ route('items.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>