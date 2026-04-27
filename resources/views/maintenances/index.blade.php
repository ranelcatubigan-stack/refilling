<x-app-layout>
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h2 class="text-2xl font-bold mb-6">Maintenance Management</h2>

                {{-- SUCCESS --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ERROR --}}
                @if(session('error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- VALIDATION ERRORS --}}
                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- ========================= --}}
                {{-- INPUT FORM (TOP) --}}
                {{-- ========================= --}}
                <form method="POST" action="{{ route('maintenances.store') }}"
                      class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                    @csrf

                    {{-- Item --}}
                    <select name="item_id" class="border p-2 rounded w-full" required>
                        <option value="">-- Select Item --</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}"
                                {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->item_name }} (Stock: {{ $item->quantity }})
                            </option>
                        @endforeach
                    </select>

                    {{-- Quantity --}}
                    <input type="number" name="maintenance_quantity"
                           placeholder="Quantity Used"
                           value="{{ old('maintenance_quantity') }}"
                           class="border p-2 rounded w-full" required>

                    {{-- Start Date --}}
                    <input type="date" name="start_date"
                           value="{{ old('start_date') }}"
                           class="border p-2 rounded w-full" required>

                    {{-- Cost --}}
                    <input type="number" step="0.01" name="cost"
                           placeholder="Cost"
                           value="{{ old('cost') }}"
                           class="border p-2 rounded w-full" required>

                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 md:col-span-1">
                        Save
                    </button>
                </form>

                {{-- ========================= --}}
                {{-- TABLE (BOTTOM) --}}
                {{-- ========================= --}}
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 border">#</th>
                                <th class="p-2 border">Employee</th>
                                <th class="p-2 border">Item</th>
                                <th class="p-2 border">Qty</th>
                                <th class="p-2 border">Start</th>
                                <th class="p-2 border">End</th>
                                <th class="p-2 border">Cost</th>
                                <th class="p-2 border">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($maintenances as $maintenance)
                                <tr class="text-center hover:bg-gray-50">

                                    <td class="border p-2">{{ $maintenance->id }}</td>

                                    <td class="border p-2">
                                        {{ optional($maintenance->user)->name ?? 'N/A' }}
                                    </td>

                                    <td class="border p-2">
                                        {{ $maintenance->item->item_name ?? 'N/A' }}
                                    </td>

                                    <td class="border p-2">
                                        {{ $maintenance->maintenance_quantity }}
                                    </td>

                                    {{-- ✅ Fixed: formatted dates for readability --}}
                                    <td class="border p-2">
                                        {{ $maintenance->start_date
                                            ? \Carbon\Carbon::parse($maintenance->start_date)->format('M d, Y')
                                            : 'N/A' }}
                                    </td>

                                    <td class="border p-2">
                                        {{ $maintenance->end_date
                                            ? \Carbon\Carbon::parse($maintenance->end_date)->format('M d, Y')
                                            : 'Ongoing' }}
                                    </td>

                                    <td class="border p-2">
                                        ₱{{ number_format($maintenance->cost, 2) }}
                                    </td>

                                    <td class="border p-2">
                                        <a href="{{ route('maintenances.edit', $maintenance->id) }}"
                                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-4 text-center text-gray-500">
                                        No maintenance records found.
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