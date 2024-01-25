<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">

            <a href="/">
                <img src="img/logo.png" alt="" width="100">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>

                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <br>
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <!-- Remember Me -->
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Mantener sesión activa') }}</span>
                    </label>
                </div>
                <div class="col-6 d-flex align-items-center">
                    <label for="show-password" class="cursor-pointer">
                        <input type="checkbox" id="show-password"> Mostrar contraseña
                    </label>
                </div>
            </div>





            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Recuperar contraseña?') }}
                    </a>
                @endif
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary">{{ __('INGRESAR') }}</button>
            </div>
        </form>

    </x-auth-card>

</x-guest-layout>
{{-- MOSTRAR CONTRASEÑA --}}
<script>
  console.log(localStorage.clear());
    const passwordInput = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('show-password');

    showPasswordCheckbox.addEventListener('change', function() {
        passwordInput.type = this.checked ? 'text' : 'password';
    });
</script>
