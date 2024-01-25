<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="text-gray-100">
                <img src="{{asset('img/logo.png')}}" alt="" width="100">                
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('¿Ha olvidado su contraseña? No hay problema. Sólo tienes que indicarnos tu dirección de correo electrónico y te enviaremos un enlace para restablecer la contraseña que te permitirá elegir una nueva.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <button class="btn btn-primary">{{ __('Enviar link de recuperación') }}</button>
            </div>
            <div class="flex items-center justify-center mt-4">
                <a href="{{ route('login') }}">Iniciar Sesión</a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
