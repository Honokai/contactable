<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editing contact') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12 flex items-center justify-center">
        
            <div class="w-96 p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                <form class="flex flex-col gap-4" method="POST" action="{{ route('contacts.update', $contactInformaction) }}">
                    @method('put')
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$contactInformaction?->name ?? old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="contact" :value="__('Contact')" />
                        <x-text-input id="contact" class="block mt-1 w-full" type="text" name="contact" :value="old('contact') ?? $contactInformaction?->contact" required autofocus autocomplete="contact" />
                        <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('E-mail')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="$contactInformaction?->email ?? old('email')" required autofocus autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="text-end mt-2">
                        <x-primary-button class="">
                            Update
                        </x-primary-button>
                    </div>
                </form>
            </div>
        
    </div>
</x-app-layout>