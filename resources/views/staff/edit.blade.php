<x-app-layout>
    <x-section>
        <x-form
            method="PATCH"
            action="/staff/{{ $staff->id }}"
        >
            <div class="flex flex-col">
                <div class="p-2">
                    <label class="p-6 mb-2 uppercase font-bold text-xs text-gray-700" for="firstName"> First Name </label>
                    <x-input class="border border-gray-400 p-1.5 m-2"
                            name="firstName" id="firstName"
                            value="{{ $staff->firstName }}">
                        {{ $staff->firstName }}
                    </x-input>
                </div>
                <div class="p-2">
                    <label class=" p-6 mb-2 uppercase font-bold text-xs text-gray-700" for="lastName"> Last Name </label>
                    <x-input class=" border border-gray-400 p-1.5 m-2"
                            name="lastName" id="lastName"
                            value="{{ $staff->lastName }}">
                        {{ $staff->lastName }}
                    </x-input>
                </div>
                <div class="p-2">
                    <label class=" p-6 mb-2 uppercase font-bold text-xs text-gray-700" for="designation"> Designation </label>
                    <x-input class="border border-gray-400 p-1.5"
                            name="designation" id="designation"
                            value="{{ $staff->designation }}">
                        {{ $staff->designation }}
                    </x-input>
                </div>
                {{-- <div class="basis-1/4" >
                    <label class="mb-2 uppercase font-bold text-xs text-gray-700" for="email"> Email </label>
                    <x-input class="border border-gray-400 p-2 w-fhalf"
                            name="email" id="email"
                            value="{{ $staff->email }}">
                        {{ $staff->email }}
                    </x-input> --}}
                </div>

            </div>

            <div class="mb-6">
                <button type="submit"
                        class="bg-blue-400 text-red rounded py-2 px-4 hover:bg-blue-500"
                >
                    Submit
                </button>
            </div>
        </x-form>
    </x-section>
</x-app-layout>
