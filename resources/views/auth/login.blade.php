<x-guest-layout>
  
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if (session('registration_success'))
    <div class="alert alert-danger text-center mx-auto" style="max-width: 600px;">
        {{ session('registration_success') }}
    </div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <img src="/assets/image/LogoCouleur.png" alt="Nom de l'Entreprise" >
        <h2 class="connexion">Connexion</h2>
        <p class="mb-3 mt-3 text-center">Veuillez rentrez votre login et mot de passe:</p>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
        <a class="underline text-sm text-gray-600 hover:text-gray-900 mr-3" href="{{ route('register') }}">
            {{ __("S'inscrire") }}
        </a>
    </form>
</x-guest-layout>
