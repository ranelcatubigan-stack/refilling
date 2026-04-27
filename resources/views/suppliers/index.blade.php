<x-app-layout>
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h2 class="text-2xl font-bold mb-6">Supplier Management</h2>

                {{-- SUCCESS MESSAGE --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ADD SUPPLIER FORM --}}
                <form method="POST" action="{{ route('suppliers.store') }}"
    class="bg-white p-6 rounded-lg shadow-md space-y-6">

    @csrf

    <!-- SUPPLIER INFO -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <h3 class="text-lg font-semibold mb-3">Supplier Info</h3>
        <input type="text" name="supplier_name" placeholder="Supplier Name"
            class="border p-2 rounded w-full" required>

        <input type="text" name="contact_number" placeholder="Contact Number"
            class="border p-2 rounded w-full" required>

        <input type="email" name="email_address" placeholder="Email Address"
            class="border p-2 rounded w-full" required>
    </div>

    <!-- ADDRESS SECTION TITLE -->
    <div class="border-t pt-4">
        <h3 class="text-lg font-semibold mb-3">Address</h3>

        <!-- ADDRESS GRID (like your image) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div>
                <label class="text-sm text-gray-600">Street Address</label>
                <input type="text" name="street_address"
                    class="border p-2 rounded w-full" placeholder="Street Address">
            </div>

            <div>
                <label class="text-sm text-gray-600">Barangay</label>
                <input type="text" name="barangay"
                    class="border p-2 rounded w-full" placeholder="Barangay">
            </div>

            <div>
                <label class="text-sm text-gray-600">City</label>
                <input type="text" name="city"
                    class="border p-2 rounded w-full" placeholder="City">
            </div>

            <div>
                <label class="text-sm text-gray-600">Region</label>
                <input type="text" name="region"
                    class="border p-2 rounded w-full" placeholder="Region">
            </div>

            <div>
                <label class="text-sm text-gray-600">Zip Code</label>
                <input type="text" name="zip_code"
                    class="border p-2 rounded w-full" placeholder="Zip Code">
            </div>

            <div>
                <label class="text-sm text-gray-600">Country</label>
                <input type="text" name="country"
                    class="border p-2 rounded w-full" placeholder="Country">
            </div>

        </div>
    </div>

    <!-- BUTTON -->
    <div class="pt-4">
        <button type="submit">
            Add Supplier
        </button>
    </div>

</form>

                {{-- TABLE --}}
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 text-sm">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 border">#</th>
                                <th class="p-2 border">Supplier</th>
                                <th class="p-2 border">Contact</th>
                                <th class="p-2 border">Email</th>
                                <th class="p-2 border">City</th>
                                <th class="p-2 border">Country</th>
                                <th class="p-2 border">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($suppliers as $supplier)
                                <tr class="text-center hover:bg-gray-50">

                                    <td class="border p-2">{{ $supplier->id }}</td>
                                    <td class="border p-2 font-semibold">{{ $supplier->supplier_name }}</td>
                                    <td class="border p-2">{{ $supplier->contact_number }}</td>
                                    <td class="border p-2">{{ $supplier->email_address }}</td>
                                    <td class="border p-2">{{ $supplier->city }}</td>
                                    <td class="border p-2">{{ $supplier->country }}</td>

                                    <td class="border p-2">

                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Delete this supplier?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-4 text-center text-gray-500">
                                        No suppliers found.
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