@extends('layouts.app1')
@section('title', 'Bicentenario Bolivia / register')

@section('content')
    <div class="wrapper"> 
        <form method="POST" action="{{ route('register') }}" class="login-container custom-login-container">
            @csrf
            <h2 class="login-title">Registro</h2>
            <!-- Name -->
            <div>
                <x-input-label class="lavel-sub" for="name" :value="__('Nombre Completo')" />
                <x-text-input id="name" class=" login-input block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4"> 
                <x-input-label class="lavel-sub" for="email" :value="__('Correo Electronico')" />
                <x-text-input id="email" class=" login-input block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- -------------------------------------- -->
            <!-- Password -->
            <div class="mt-4">
                <x-input-label class="lavel-sub" for="password" :value="__('Contraseña')" />

                <div class="relative w-full">
                    <!-- Campo de contraseña -->
                    <x-text-input id="password" class="login-input block mt-1 w-full pr-10" type="password" name="password" required
                        autocomplete="new-password" />

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

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label class="lavel-sub" for="password_confirmation" :value="__('Repita Contraseña')" />
                <div class="relative w-full">
                    <!-- Campo de confirmación de contraseña -->
                    <x-text-input id="password_confirmation" class="login-input  wblock mt-1-full pr-10" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    
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

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <!-- -------------------------------------- -->
            <!-- Género -->
            <div class="mt-4 select-wrapper">
                <x-input-label class="lavel-sub" for="gender" :value="__('Genero')" />
                    <select id="gender" name="gender" class="select-custom login-input block mt-1 w-full ">

                        <option value="">Seleccione su género</option>
                        <option value="male">Masculino</option>
                        <option value="female">Femenino</option>
                        <option value="other">Otro</option>
                    </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <!-- País -->
            <div class="mt-4">
                <x-input-label class="lavel-sub" for="country" :value="__('Pais')" />
                <select id="country" name="country"
                    class="login-input block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                <x-input-label class="lavel-sub" for="city" :value="__('Ciudad')" />
                <select id="city" name="city"
                    class="login-input block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Seleccione una ciudad</option>
                </select>
                <x-input-error :messages="$errors->get('state')" class="mt-2" />
            </div>

            <!-- CAPTCHA personalizado -->
            <div class="mt-4">
                <x-input-label class="lavel-sub" for="captcha" :value="__('CAPTCHA')" />
                <p class="font-bold text-lg">Resuelve: {{ $captchaNum1 }} + {{ $captchaNum2 }} = ?</p>
                <x-text-input id="captcha" class="login-input block mt-1 w-full" type="number" name="captcha" required />
                <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center text-center mt-4">
                <x-primary-button class="login-button">
                    {{ __('REGISTRARSE') }}
                </x-primary-button>
                <a class="forgot-password ms-4" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>
            </div>
        </form>
        <x-input-error :messages="$errors->get('city')" class="mt-2" />
    </div>
@endsection
