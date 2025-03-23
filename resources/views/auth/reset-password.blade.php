<x-guest-layout>  
<div class="min-h-screen flex items-center justify-center"> 
    <form method="POST" action="{{ route('password.store') }}" class="login-container">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <!-- Email Address -->
        <div>
            <x-input-label class="lavel-sub" for="email" :value="__('Correo Electronico')" />
            <x-text-input id="email" class="login-input block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label class="lavel-sub" for="password" :value="__('Contraseña')" />
            <div class="relative w-full">
                <x-text-input id="password" class="login-input block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <!-- Botón del ícono del ojo -->
                <button type="button" onclick="togglePassword('password', 'eye-icon-1')"
                        class="eye-icon">
                        <svg id="eye-icon-1" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                </button>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label class="lavel-sub" for="password_confirmation" :value="__('Confirmar contraseña')" />
            <div class="relative w-full">
            <x-text-input id="password_confirmation" class="login-input block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')"
                    class="eye-icon">
                    <svg id="eye-icon-2" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 " viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
                </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="login-button">
                {{ __('Restablecer contraseña') }}
            </x-primary-button>
        </div>
    </form>
</div>
</x-guest-layout>
