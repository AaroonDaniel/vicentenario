<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('https://source.unsplash.com/random/1600x900/?nature');">
        <div class="card w-full max-w-md p-6 bg-white rounded-lg shadow-xl">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">
                ¡Gracias por registrarte!
            </h2>
            <p class="mb-4 text-sm text-gray-600">
                Antes de comenzar, por favor verifica tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte.<br>
                Si no recibiste el correo, podemos enviártelo nuevamente.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('Se ha enviado un nuevo enlace de verificación al correo electrónico proporcionado durante el registro.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}" class="login-container">
                    @csrf
                    <x-primary-button class="bg-pink-700 hover:bg-pink-600 text-white px-4 py-2 rounded">
                        {{ __('Reenviar Correo de Verificación') }}
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Cerrar Sesión') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>