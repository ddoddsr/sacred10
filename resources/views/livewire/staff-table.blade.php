<x-app-layout>

    <div class="ml-6 p-2">
        Here is Staff Table
    </div>
    <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        {{ __('return to Dashboard') }}
    </x-responsive-nav-link>

</x-app-layout>
