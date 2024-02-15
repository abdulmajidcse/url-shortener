<x-app-layout>
    <x-slot name="title">
        Short URL List
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Short URL List
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <x-link-button href="{{ route('shorturls.create') }}">New Short URL</x-link-button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                {{-- success message --}}
                @if (session()->has('success_message'))
                    <x-success-message :message="session()->get('success_message')" />
                @endif

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
                                    Main URL
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400">
                                    Short URL
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400">
                                    Total Clicks
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase    tracking-wider dark:bg-gray-800 dark:text-gray-400">
                                    Create date of URL
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-none">
                            @php
                                $sl = $shortUrls->firstItem();
                            @endphp
                            @forelse ($shortUrls as $shortUrl)
                                <tr class="bg-white dark:bg-gray-700 dark:text-white text-left">
                                    <th scope="row" class="px-6 py-4  text-sm font-medium dark:text-white">
                                        {{ $sl++ }}
                                    </th>

                                    <th class="px-6 py-4 text-sm font-medium dark:text-white">
                                        <div class="flex gap-2">
                                            <div class="max-w-[300px] overflow-x-auto">
                                                {{ $shortUrl->main_url }}
                                            </div>

                                            <div onClick="copyToClipboard(`{{ $shortUrl->main_url }}`)"
                                                title="Click to copy">
                                                <x-copy-icon />
                                            </div>
                                        </div>
                                    </th>

                                    <th class="px-6 py-4 text-sm font-medium dark:text-white">
                                        <div class="flex gap-2">
                                            <div>
                                                {{ route('shorturls.redirect', $shortUrl->short_url_path) }}
                                            </div>

                                            <div onClick="copyToClipboard(`{{ route('shorturls.redirect', $shortUrl->short_url_path) }}`)"
                                                title="Click to copy">
                                                <x-copy-icon />
                                            </div>
                                        </div>
                                    </th>

                                    <th class="px-6 py-4 text-sm font-medium dark:text-white">
                                        {{ $shortUrl->click_count }}
                                    </th>

                                    <th class="px-6 py-4 text-sm font-medium dark:text-white">
                                        {{ $shortUrl->created_at->format('Y-m-d') }}
                                    </th>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white">
                                        <div class="space-x-2">
                                            <form action="{{ route('shorturls.destroy', $shortUrl->id) }}"
                                                method="post" class="inline">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="underline text-red-500 hover:no-underline"
                                                    onclick="return confirm(`Are you sure?`);">Delete</button>
                                            </form>
                                        </div>
                                    </td>
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
                    {{ $shortUrls->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function copyToClipboard(url) {
                let copyUrl = document.createElement('textarea');
                copyUrl.value = url;
                document.body.appendChild(copyUrl);
                copyUrl.select();
                document.execCommand('copy');
                document.body.removeChild(copyUrl);

                alert('The URL copied to clipboard: ' + url);
            }
        </script>
    @endpush
</x-app-layout>
