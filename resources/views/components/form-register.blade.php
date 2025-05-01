@props(['roles'])


<div class="md:w-1/2 p-8 relative flex flex-col justify-center bg-white">
    <div class="absolute top-0 left-0 w-40 h-40 bg-blue-900 rounded-full -ml-20 -mt-20">
    </div>
    <div class="absolute bottom-0 right-0 w-40 h-40 bg-red-500 rounded-full -mr-20 -mb-20">
    </div>
    <div class="text-center mb-8 relative z-10">
        <h2 class="text-2xl font-bold text-gray-800">
            CREATE AN </h2>
        <h1 class="text-3xl font-bold text-red-500">
            Account
        </h1>
    </div>
    <form action="{{ route('register') }}" method="POST" class="relative z-10">
        @csrf
        <div class="mb-4">

        </div>
        <div class="mb-4">
            <label class="block text-gray-700">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus
                    autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </label>
        </div>
        {{-- <div class="mb-4">
            <label class="block text-gray-700">
                <x-input-label for="role" :value="__('Role')" />
                <select id="role" name="role"
                    class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-opacity-50"
                    required>
                    <option value="">Select Role</option>
                    @foreach ($roles->where('name', '!=', 'Super admin') as $role)
                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                            {{ $role->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </label>
        </div> --}}

        <button
            class="bg-gradient-to-r from-red-500 to-blue-950 text-white font-bold py-3 rounded-lg w-full shadow-lg hover:from-red-600 hover:to-blue-600">
            SIGN UP
        </button>
    </form>
    <div
        class="text-center text-red-500 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-b from-red-500 to-blue-950 mt-6 relative z-10">
        <a href="{{ route('login') }}">
            Already have an account
        </a>
    </div>
</div>
