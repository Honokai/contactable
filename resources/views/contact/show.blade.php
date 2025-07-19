<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Details') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12 flex items-center justify-center">

            <div class="w-96 flex flex-col gap-2 p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div>
                    <x-input-label for="id" :value="__('ID')" />
                    <x-text-input readonly disabled id="name" aria-label="disabled input" class="brightness-[85%] cursor-not-allowed block mt-1 w-full" type="text" :value="$contactInformaction->id"/>
                </div>

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input readonly disabled id="name" aria-label="disabled input" class="brightness-[85%] cursor-not-allowed block mt-1 w-full" type="text" :value="$contactInformaction->name"/>
                </div>

                <div>
                    <x-input-label for="contact" :value="__('Contact')" />
                    <x-text-input disabled readonly id="contact" aria-label="disabled input" class="brightness-[85%] cursor-not-allowed block mt-1 w-full" type="text" :value="$contactInformaction->contact_formatted"/>
                </div>

                <div>
                    <x-input-label for="email" :value="__('E-mail')" />
                    <x-text-input disabled readonly id="email" aria-label="disabled input" class="brightness-[85%] cursor-not-allowed block mt-1 w-full" type="text" :value="$contactInformaction->email"/>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a class="inline-flex items-center p-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150" href="{{route('contacts.edit', $contactInformaction)}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil-icon lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                    </a>
                    <form action="{{route('contacts.destroy', $contactInformaction)}}" method="POST">
                        @method('delete')
                        @csrf
                        <x-danger-button class="p-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        </x-danger-button>
                    </form>
                </div>
            </div>
    </div>
</x-app-layout>