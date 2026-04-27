<x-app-layout>
    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h2 class="text-xl font-bold mb-4">Employee Information</h2>

                <!-- SEARCH FORM -->
                <form method="GET" action="{{ route('employees.index') }}" class="mb-6">

                    <label class="block mb-2 font-semibold">Select Employee</label>

                    <select name="user_id" class="w-full border-gray-300 rounded-md" required>
                        <option value="">-- Select Employee --</option>

                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->first_name }} {{ $user->last_name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit">
                        Search Employee
                    </button>
                </form>

                <!-- RESULT -->
                @if($selectedUser)
                    <div class="border rounded-lg p-4">

                        <h3 class="text-lg font-semibold mb-4">Employee Details</h3>

                        <table class="w-full border border-gray-300">

                            <tr class="border-b">
                                <th class="text-left p-2 bg-gray-100">First Name</th>
                                <td class="p-2">{{ $selectedUser->first_name }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="text-left p-2 bg-gray-100">Middle Name</th>
                                <td class="p-2">{{ $selectedUser->middle_name ?? '-' }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="text-left p-2 bg-gray-100">Last Name</th>
                                <td class="p-2">{{ $selectedUser->last_name }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="text-left p-2 bg-gray-100">Email</th>
                                <td class="p-2">{{ $selectedUser->email }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="text-left p-2 bg-gray-100">Contact Number</th>
                                <td class="p-2">{{ $selectedUser->contact_number }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="text-left p-2 bg-gray-100">PhilHealth</th>
                                <td class="p-2">{{ $selectedUser->philhealth }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="text-left p-2 bg-gray-100">SSS</th>
                                <td class="p-2">{{ $selectedUser->sss }}</td>
                            </tr>

                            <tr class="border-b">
                                <th class="text-left p-2 bg-gray-100">Pag-IBIG</th>
                                <td class="p-2">{{ $selectedUser->pagibig }}</td>
                            </tr>

                        </table>

                    </div>
                @else
                    <p class="text-gray-500">Please select an employee to view details.</p>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>