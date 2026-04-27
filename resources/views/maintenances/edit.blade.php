<x-app-layout>
<div class="py-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

        <h2 class="text-xl font-bold mb-4">Update Maintenance</h2>

        <form method="POST" action="{{ route('maintenances.update', $maintenance->id) }}">
            @csrf
            @method('PUT')

            <label class="block mb-2">End Date</label>
            <input type="date" name="end_date"
                value="{{ $maintenance->end_date }}"
                class="w-full border p-2 rounded mb-4">

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>

    </div>
</div>
</x-app-layout>