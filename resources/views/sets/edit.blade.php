<x-app-layout>
    <x-section>
        <x-form
            method="PATCH"
            action="/sets/{{ $set->id }}"
        >
            <div class="mb-6 w-half flex">
                <label class="block mb-2 mr-2 uppercase font-bold text-xs text-gray-700"> Day {{ $set->dayOfWeek }}
                </label>

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"> Set {{ $set->setOfDay }}
                </label>
            </div>
            <div class="flex">
                <label class="mb-2 uppercase font-bold text-xs text-gray-700" for="worshipLeader"> Worship Leader </label>
                <x-input class="border border-gray-400 p-2 w-fhalf"
                          name="worshipLeader" id="worshipLeader"
                          value="{{ $set->worshipLeader }}">
                    {{ $set->worshipLeader }}
                </x-input>


                <label class="mb-2 uppercase font-bold text-xs text-gray-700" for="prayerLeader"> Prayer Leader </label>
                <x-input class="border border-gray-400 p-2 w-half"
                          name="prayerLeader" id="prayerLeader"
                            value="{{ $set->prayerLeader }}"
                >
                    {{ $set->prayerLeader }}
                </x-input>

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="sectionLeader"> Section Leader </label>
                <x-input class="border border-gray-400 p-2 w-half"
                          name="sectionLeader" id="sectionLeader"
                        value="{{ $set->sectionLeader }}"
                >
                {{ $set->sectionLeader }}
                </x-input>
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
