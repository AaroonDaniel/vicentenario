<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center"> 
        <form method="POST" action="{{ route('password.email') }}" class="login-container">
            @csrf
            <!-- Título -->
            <h1 class="login-title">Recuperar contraseña</h1>
            <!-- Mensaje Flash de Éxito  -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Email Address / Contraseña olvidada -->
            <div>
                <x-input-label class="lavel-sub" for="email" :value="__('Introduce tu correo electrónico')" />
                <x-text-input id="email" class="login-input block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="login-button">
                    {{ __('Enviar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
