<x-app-layout>
    <x-slot name="title">
        New Short URL
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            New Short URL
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <x-link-button href="{{ route('shorturls.index') }}">Short URL List</x-link-button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                {{-- error message --}}
                @if (session()->has('error_message'))
                    <x-error-message :message="session()->get('error_message')" />
                @endif

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <form method="post" action="{{ route('shorturls.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="main_url" :value="__('Main URL')" />
                                <x-text-input id="main_url" name="main_url" type="url" class="mt-1 block w-full"
                                    :value="old('main_url')" required autofocus autocomplete="main_url" />
                                <x-input-error class="mt-2" :messages="$errors->get('main_url')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>Generate Shorten URL</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
