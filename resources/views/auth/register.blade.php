<x-guest-layout>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="my-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="mb-3">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Type Compte -->
        <div class="mt-4">
            <x-input-label for="type_compte" :value="__('Type Compte')" />
            <select id="type_compte" name="type_compte" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="type_compte">
                <option value=""></option>
                <option value="Traitant">Traitant</option>
                <option value="Infirmier">Infirmier/Infirmière</option>
                <option value="Receptionniste">Réceptionniste</option>
            </select>
            <x-input-error :messages="$errors->get('type_compte')" class="mt-2" />
        </div>

        <!-- Département -->
        <div id="departement-container" class="mt-4 hidden">
            <x-input-label for="departement" :value="__('Département')" />
            <select id="departement" name="departement" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" required autofocus autocomplete="departement">
                <option value=""></option>
                <option value="Pediatrie">Pédiatrie</option>
                <option value="Neonatologie">Néonatologie</option>
                <option value="Chirurgie Pediatrie">Chirurgie Pédiatrie</option>
            </select>
            <x-input-error :messages="$errors->get('departement')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà inscrit?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __("Enregistrer") }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
