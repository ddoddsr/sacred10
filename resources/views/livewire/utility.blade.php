<x-app-layout>
    <div class="ml-6 p-2">
   <span class="center-content">Utilities</span>
        {{-- class="mt-3  text-sm text-indigo-600" --}}
           
           
        <div class="mt-6 p-2 ">
            <x-form-button  method="POST" action="importNewestStaffSchedules" >
                {{ __('Import Newest FormSite Staff and schedule Data') }}
            </x-form-button>   
        </div>
        <div class="p-2 ">
            <x-form-button  method="POST" action="truncateSchedules" >
                {{ __('Truncate Schedule Table') }}
            </x-form-button>   
        </div>
        <div class="p-2 ">
            <x-form-button method="POST" action="importStaffSchedules" >
                {{ __('Import FormSite Staff and schedule Data') }}
            </x-form-button>   
        </div>
        <div class="p-2 ">
            <x-form-button method="GET" action="/pdf" >
                {{ __('Generate PDF for sets') }}
            </x-form-button>   
        </div>  
                    
    </div>

    <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        {{ __('return to Dashboard') }}
    </x-responsive-nav-link>
</x-app-layout>
