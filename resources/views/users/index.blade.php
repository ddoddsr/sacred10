<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-mxl text-center my-10"> Users Blade -- views users index 1 </h1>
    </div>

{{-- <@livewire('component', ['user' => $user], key($user->id))   --}}
<livewire:users-table>
</x-app-layout>
