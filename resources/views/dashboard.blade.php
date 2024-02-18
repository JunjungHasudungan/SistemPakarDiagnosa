<x-app-layout>
    @php
        $pageTitle = 'Dashboard';
    @endphp

    <title>{{$pageTitle}} | {{ config('app.name') }} </title>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-400 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (auth()->user()->role_id != 1)
                        <livewire:guest-dashboard />
                    @else
                        <livewire:admin-dashboard />
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
