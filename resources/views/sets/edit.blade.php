<x-app-layout>
    <x-section>
        <x-form
            method="PATCH"
            action="/sets/{{ $set->id }}"
        >


            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="dayOfWeek"
                >
                    Day {{ $set->dayOfWeek }}
                </label>

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                for="dayOfWeek"
                >
                    Set {{ $set->setOfDay }}
                </label>
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="title"
                >
                    Title
                </label>

                <textarea class="border border-gray-400 p-2 w-full"
                          name="title"
                          id="title"
                          required
                >
                    {{ $set->title }}
                </textarea>

                @error('title')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
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
