<div class="">
    <div class="w-full flex ">
        <div class="w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-6 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"placeholder="Search users...">
        </div>
        <div class="relative flex items-start">
            <div class="flex items-center h-5">
                <input wire:model="active" id="active" type="checkbox"
                    class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
            </div>
            <div class="ml-3 text-sm leading-5">
                <label for="active" class="font-medium text-gray-700">Active?</label>
            </div>
        </div>

        {{-- <div class="w-1/6 relative mx-1 ">
            <select wire:model="orderBy" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="id">ID</option>
                <option value="name">Name</option>
                <option value="email">Email</option>
                <option value="created_at">Sign Up Date</option>
            </select> --}}
            {{-- <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div> --}}
        {{-- </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="orderAsc" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select> --}}
            {{-- <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div> --}}
        {{-- </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="perPage" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option>12</option>
                <option>20</option>
                <option>50</option>
                <option>100</option>
            </select> --}}
            {{-- <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div> --}}
        {{-- </div> --}}
    </div>
    <table class="table-auto w-full mt-4 mb-6">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->id }}</td>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ $user->created_at->diffForHumans() }}</td>
                    <td class="border px-4 py-2">
                        {{-- <x-button type="submit class="ml-3" > --}}
                        <button
                            type="button" wire:click="edit('{{ $user->id }}')"
                            class="bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm">Edit
                        </button>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $users->links() !!}
    <br>
    {{-- <x-t-model>
    </x-t-model> --}}

</div>
