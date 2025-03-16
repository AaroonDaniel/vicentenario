<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre Completo')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electronico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <div class="relative w-full">
                <!-- Botón del ícono del ojo -->
                <button type="button" onclick="togglePassword('password', 'eye-icon-1')"
                    class="absolute bottom-10 inset-y-9 right-0 flex items-center">
                    <svg id="eye-icon-1" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-gray-500 hover:text-gray-700 cursor-pointer" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
                <!-- Campo de contraseña -->
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-5">
            <x-input-label for="password_confirmation" :value="__('Repita Contraseña')" />

            <div class="relative w-full">
                <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')"
                    class="absolute bottom-10 inset-y-9 right-0 flex items-center">
                    <svg id="eye-icon-2" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-gray-500 hover:text-gray-700 cursor-pointer" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
                <!-- Campo de confirmación de contraseña -->
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Género -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Genero')" />
            <select id="gender" name="gender"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Seleccione su género</option>
                <option value="male">Masculino</option>
                <option value="female">Femenino</option>
                <option value="other">Otro</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- País -->
        <div class="mt-4">
            <x-input-label for="country" :value="__('Pais')" />
            <select id="country" name="country"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Seleccione su país</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
                <!-- Agrega más opciones según sea necesario -->
            </select>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <!-- Ciudades -->
        <div class="mt-4">
            <x-input-label for="city" :value="__('Ciudad')" />
            <select id="city" name="city"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Seleccione una ciudad</option>
            </select>
            <x-input-error :messages="$errors->get('state')" class="mt-2" />
        </div>

        <!-- CAPTCHA personalizado -->
        <div class="mt-4">
            <x-input-label for="captcha" :value="__('CAPTCHA')" />
            <p class="font-bold text-lg">Resuelve: {{ $captchaNum1 }} + {{ $captchaNum2 }} = ?</p>
            <x-text-input id="captcha" class="block mt-1 w-full" type="number" name="captcha" required />
            <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <x-input-error :messages="$errors->get('city')" class="mt-2" />
</x-guest-layout>
