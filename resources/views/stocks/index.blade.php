<x-app-layout>
    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

            <h2 class="text-xl font-bold mb-4">Stock In (Add Gallons)</h2>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('stocks.store') }}">
                @csrf

                <!-- SELECT ITEM -->
                <div class="mb-4">
                    <label class="block mb-1">Select Item</label>
                    <select name="item_id" class="w-full border rounded p-2">
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->item_name }} (Stock: {{ $item->quantity }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- QUANTITY -->
                <div class="mb-4">
                    <label class="block mb-1">Quantity (Gallons)</label>
                    <input type="number" name="quantity" class="w-full border rounded p-2" required>
                </div>

                <!-- DATE -->
                <div class="mb-4">
                    <label class="block mb-1">Date</label>
                    <input type="date" name="date" class="w-full border rounded p-2" required>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Add Stock
                </button>
            </form>

        </div>
    </div>

    <div class="py-6">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Stock History</h2>

                <a href="{{ route('stocks.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Add Stock
                </a>
            </div>

            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2">Item</th>
                        <th class="p-2">Quantity</th>
                        <th class="p-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stocks as $stock)
                        <tr class="border-t text-center">
                            <td class="p-2">{{ $stock->item->item_name }}</td>
                            <td class="p-2">+{{ $stock->quantity }}</td>
                            <td class="p-2">{{ $stock->date }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-2 text-center">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>