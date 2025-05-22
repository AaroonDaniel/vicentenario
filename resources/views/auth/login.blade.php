@extends('layouts.app1')
@section('title', 'Bicentenario Bolivia / login')



@section('content')
<!-- Session Status -->
<div>
    <div class="wrapper"> 

        <form method="POST" action="{{ route('login') }}" class="login-container">
            @csrf
            <!-- Mensaje Flash de Éxito -->
            <x-auth-session-status class="mb-4 text-white-600 text-center" :status="session('status')" />
            
            <h2 class="login-title">Iniciar sesión</h2> 
            <!-- Email Address -->
            <div>
                <x-input-label class="lavel-sub" class_uses for="email" :value="__('Correo electrónico')" />
                <x-text-input id="email" class="login-input block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>



            <!-- Password -->
            <div class="mt-4">
                <x-input-label class="lavel-sub" for="password" :value="__('Contraseña')" />
                <div class="relative w-full">
                <x-text-input id="password" class="login-input block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
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

            <!-- Remember Me -->
            <div class="block mt-3 ms-3">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="checkbox-input rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-900">{{ __('Remember me') }}</span>
                </label>
            </div>
            <!-- INGRESAR-->
            <div class="flex items-center justify-center text-center mt-4">       
                <x-primary-button class="login-button">
                    {{ __('Ingresar') }}
                </x-primary-button>
            </div>
            <div class="flex items-center justify-center mt-4 text-center">
                @if (Route::has('password.request'))
                    <a class="forgot-password underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>
            <div class="button-container flex items-center justify-end mt-4">
                <p class="mb-0 me-2">No tienes cuenta?</p>
                <a href="{{ route('register') }}" class="custom-button">
                    {{ __('Crear cuenta') }}
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
