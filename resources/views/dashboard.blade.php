<x-app-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->is_admin ? 'Admin ' : '' }} Dashboard
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <x-link-button href="{{ route('shorturls.create') }}">New Short URL</x-link-button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-3">
                @if (auth()->user()->is_admin)
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        User List
                    </h2>

                    <div class="shadow overflow-x-auto border-b border-gray-200 dark:border-gray-700 sm:rounded-lg">
                        <table class="w-full divide-y divide-gray-200 dark:divide-none">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400">
                                        SL
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400">
                                        Name
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400">
                                        Email
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400">
                                        Total Short URL
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase    tracking-wider dark:bg-gray-800 dark:text-gray-400">
                                        Account Create Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-none">
                                @php
                                    $sl = $users->firstItem();
                                @endphp
                                @forelse ($users as $user)
                                    <tr class="bg-white dark:bg-gray-700 dark:text-white text-left">
                                        <th scope="row" class="px-6 py-4  text-sm font-medium dark:text-white">
                                            {{ $sl++ }}
                                        </th>

                                        <th class="px-6 py-4 text-sm font-medium dark:text-white">
                                            {{ $user->name }}
                                        </th>

                                        <th class="px-6 py-4 text-sm font-medium dark:text-white">
                                            {{ $user->email }}
                                        </th>

                                        <th class="px-6 py-4 text-sm font-medium dark:text-white">
                                            {{ $user->short_urls_count }}
                                        </th>

                                        <th class="px-6 py-4 text-sm font-medium dark:text-white">
                                            {{ $user->created_at->format('Y-m-d') }}
                                        </th>
                                    </tr>
                                @empty
                                    <tr class="bg-white dark:bg-gray-700 dark:text-white">
                                        <th scope="row"
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white"
                                            colspan="100">
                                            <span
                                                class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">No
                                                data available!</span>
                                        </th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-2">
                        {{ $users->links() }}
                    </div>
                @else
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">Your total short URL is {{ $short_urls_count }}</div>
                        <x-link-button href="{{ route('shorturls.index') }}">Go to your Short URL List</x-link-button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
