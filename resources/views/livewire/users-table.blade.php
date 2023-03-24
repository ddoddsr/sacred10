<x-app-layout>
    <div>
        Here is UserTable{{-- The best athlete wants his opponent at his best. --}}
    </div>
    <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        {{ __('return to Dashboard') }}
    </x-responsive-nav-link>
</x-app-layout>

