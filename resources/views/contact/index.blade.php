<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    @php
        $isAuthenticated = auth()->check();
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Contact
                            </th>
                            <th scope="col" class="px-6 py-3">
                                E-mail
                            </th>

                            @if($isAuthenticated)
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contactInformation)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <td class="p-0">
                                    <a class="w-full h-full block p-4" href="{{ route('contacts.show', $contactInformation) }}">
                                        {{$contactInformation->name}}
                                    </a>
                                </td>
                                <td class="p-0">
                                    <a class="w-full h-full block p-4" href="{{ route('contacts.show', $contactInformation) }}">
                                        {{$contactInformation->contact}}
                                    </a>
                                </td>
                                <td class="p-0">
                                    <a class="w-full h-full block p-4" href="{{ route('contacts.show', $contactInformation) }}">
                                        {{$contactInformation->email}}
                                    </a>
                                </td>

                                @if($isAuthenticated)
                                    <th scope="col" class="px-6 py-3">
                                        <form action="{{route('contacts.destroy', $contactInformation)}}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <x-danger-button class="p-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                            </x-danger-button>
                                        </form>
                                    </th>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>