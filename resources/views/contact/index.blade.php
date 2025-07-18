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
                                ID
                            </th>
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
                                <th class="font-medium text-gray-900 whitespace-nowrap dark:text-white flex justify-center items-center justify-items-center">
                                    <a class="flex-1 justify-center items-center" href="{{ route('contacts.show', $contactInformation) }}">
                                        {{$contactInformation->id}}
                                    </a>
                                </th>
                                <td class="px-6 py-4">
                                    <a class="flex-1 justify-center items-center" href="{{ route('contacts.show', $contactInformation) }}">
                                        {{$contactInformation->name}}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a class="flex-1 justify-center items-center" href="{{ route('contacts.show', $contactInformation) }}">
                                        {{$contactInformation->contact}}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a class="flex-1 justify-center items-center" href="{{ route('contacts.show', $contactInformation) }}">
                                        {{$contactInformation->email}}
                                    </a>
                                </td>

                                @if($isAuthenticated)
                                    <th scope="col" class="px-6 py-3">
                                        <form action="{{route('contacts.destroy', $contactInformation)}}" method="POST">
                                            @method('delete')
                                            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Delete</button>
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