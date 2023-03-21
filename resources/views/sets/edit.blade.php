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
            <div>
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="worshipLeader"> Worship Leader </label>
                <textarea class="border border-gray-400 p-2 w-full"
                          name="worshipLeader" id="worshipLeader"
                          required
                >
                    {{ $set->worshipLeader }}
                </textarea>
            </div>
            <div>
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="prayerLeader"> Prayer Leader </label>
                <textarea class="border border-gray-400 p-2 w-full"
                          name="prayerLeader" id="prayerLeader"
                          required
                >
                    {{ $set->prayerLeader }}
                </textarea>
            </div>
            <div>
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="sectionLeader"> Section Leader </label>
                <textarea class="border border-gray-400 p-2 w-full"
                          name="sectionLeader" id="sectionLeader"
                          required
                >
                    {{ $set->sectionLeader }}
                </textarea>
            </div>





            {{-- worshipLeader
                sectionLeader
                prayerLeader
             --}}
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
