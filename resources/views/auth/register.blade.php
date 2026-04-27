<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="first_name123" value="First Name" />
            <x-text-input id="first_name123" class="block mt-1 w-full"
                type="text"
                name="first_name123"
                value="{{ old('first_name123') }}"
                required autofocus />
            <x-input-error :messages="$errors->get('first_name123')" class="mt-2" />
        </div>

        <!-- Middle Name -->
        <div class="mt-4">
            <x-input-label for="middle_name123" value="Middle Name (Optional)" />
            <x-text-input id="middle_name123" class="block mt-1 w-full"
                type="text"
                name="middle_name123"
                value="{{ old('middle_name123') }}" />
            <x-input-error :messages="$errors->get('middle_name123')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name123" value="Last Name" />
            <x-text-input id="last_name123" class="block mt-1 w-full"
                type="text"
                name="last_name123"
                value="{{ old('last_name123') }}"
                required />
            <x-input-error :messages="$errors->get('last_name123')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email123" value="Email" />
            <x-text-input id="email123" class="block mt-1 w-full"
                type="email"
                name="email123"
                value="{{ old('email123') }}"
                required />
            <x-input-error :messages="$errors->get('email123')" class="mt-2" />
        </div>

        <!-- Contact Number -->
        <div class="mt-4">
            <x-input-label for="contact_number123" value="Contact Number" />
            <x-text-input id="contact_number123" class="block mt-1 w-full"
                type="text"
                name="contact_number123"
                value="{{ old('contact_number123') }}"
                required />
            <x-input-error :messages="$errors->get('contact_number123')" class="mt-2" />
        </div>

        <!-- PhilHealth -->
        <div class="mt-4">
            <x-input-label for="philhealth123" value="PhilHealth Number" />
            <x-text-input id="philhealth123" class="block mt-1 w-full"
                type="text"
                name="philhealth123"
                value="{{ old('philhealth123') }}"
                required />
            <x-input-error :messages="$errors->get('philhealth123')" class="mt-2" />
        </div>

        <!-- SSS -->
        <div class="mt-4">
            <x-input-label for="sss123" value="SSS Number" />
            <x-text-input id="sss123" class="block mt-1 w-full"
                type="text"
                name="sss123"
                value="{{ old('sss123') }}"
                required />
            <x-input-error :messages="$errors->get('sss123')" class="mt-2" />
        </div>

        <!-- Pag-IBIG -->
        <div class="mt-4">
            <x-input-label for="pagibig123" value="Pag-IBIG Number" />
            <x-text-input id="pagibig123" class="block mt-1 w-full"
                type="text"
                name="pagibig123"
                value="{{ old('pagibig123') }}"
                required />
            <x-input-error :messages="$errors->get('pagibig123')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role123" value="Role" />
            <select name="role123" id="role123" class="block mt-1 w-full border-gray-300 rounded-md">
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
            </select>
            <x-input-error :messages="$errors->get('role123')" class="mt-2" />
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                href="{{ route('login') }}">
                Already registered?
            </a>

            <x-primary-button class="ms-4">
                Register
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>