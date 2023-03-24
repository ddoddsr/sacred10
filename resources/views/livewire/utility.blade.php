<x-app-layout>
    <div class="ml-6 p-2">
    Utilities
        <ul class="mt-3 list-disc list-inside text-sm text-indigo-600">
            <li>Import Newest FormSite Staff and schedule Data</li>
            <li>Clear schedule table</li>
            <li>Re-Import FormSite Staff and schedule from { date-range } </li>
            <li>Generate PDF for sets</li>

        </ul>

    </div>

    <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        {{ __('return to Dashboard') }}
    </x-responsive-nav-link>
</x-app-layout>
