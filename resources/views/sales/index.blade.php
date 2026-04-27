<x-app-layout>
    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

            <h2 class="text-xl font-bold mb-4">Sales / Refill</h2>

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('sales.store') }}">
                @csrf

                <!-- ITEM -->
                <div class="mb-4">
                    <label>Item</label>
                    <select name="item_id" class="w-full border p-2">
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->item_name }} (Stock: {{ $item->quantity }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- TYPE -->
                <div class="mb-4">
                    <label>Type</label>
                    <select name="type" class="w-full border p-2">
                        <option value="refill">Refill</option>
                        <option value="new">New Gallon</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="w-full border p-2" required>
                </div>

                <!-- DATE -->
                <div class="mb-4">
                    <label>Date</label>
                    <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full border p-2">
                </div>

                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    Submit
                </button>
            </form>

        </div>
    </div>

 
    <div class="py-6">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">

            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-bold">Sales History</h2>

                <a href="{{ route('sales.create') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded">
                    + New Transaction
                </a>
            </div>

            <table class="w-full border text-center">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2">Item</th>
                        <th class="p-2">Type</th>
                        <th class="p-2">Qty</th>
                        <th class="p-2">Total</th>
                        <th class="p-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        <tr class="border-t">
                            <td class="p-2">{{ $sale->item->item_name }}</td>
                            <td class="p-2">
                                {{ $sale->type == 'new' ? 'New Gallon' : 'Refill' }}
                            </td>
                            <td class="p-2">{{ $sale->quantity }}</td>
                            <td class="p-2">{{ $sale->total_price }}</td>
                            <td class="p-2">{{ $sale->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</x-app-layout>