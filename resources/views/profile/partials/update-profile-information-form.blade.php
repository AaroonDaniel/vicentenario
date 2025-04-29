<section>
    
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nombre Completo')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Su dirección de correo electrónico no está verificada.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Haz clic aquí para volver a enviar el correo electrónico de verificación') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Se ha enviado un nuevo enlace de verificación a su correo electrónico.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Campo de Género -->
        <div class="mt-4">
            <label for="gender">Género</label>
            <select name="gender" id="gender" class="form-input">
                <option value="">Selecciona...</option>
                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Femenino
                </option>
                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Masculino</option>
                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <!-- País -->
        <div class="mt-4">
            <x-input-label for="country" :value="__('País')" />
            <select id="country" name="country"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Seleccione su país</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}"
                        {{ old('country', optional($user->country)->id ?? '') == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <!-- Ciudad (State) -->
        <div class="mt-4">
            <x-input-label for="city" :value="__('Ciudad')" />
            <select id="city" name="city"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Seleccione una ciudad</option>
                @if (!empty(old('city', $user->state_id)))
                    <option value="{{ $user->state_id }}" selected>{{ optional($user->state)->name }}</option>
                @endif
            </select>
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countrySelect = document.getElementById('country');
            const citySelect = document.getElementById('city');

            if (!countrySelect || !citySelect) return;

            countrySelect.addEventListener('change', function() {
                const countryId = this.value;

                if (!countryId) {
                    citySelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                    return;
                }

                // Hacer petición fetch
                fetch("{{ route('get-states') }}?country=" + countryId)
                    .then(response => response.json())
                    .then(data => {
                        citySelect.innerHTML = data.options; // Aquí inyectamos las options
                    })
                    .catch(error => console.error('Error cargando ciudades:', error));
            });

            // Si ya hay un país preseleccionado, cargar sus ciudades al cargar la página
            @if (old('country', $user->country_id ?? null))
                countrySelect.dispatchEvent(new Event('change'));
            @endif
        });
    </script>
@endpush
