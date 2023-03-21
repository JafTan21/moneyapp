<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Construction Project Monitor dashBoard') }}
            </h2>
            {{-- <a href="#">
                Download .pdf
            </a> --}}
        </div>
    </x-slot>

    @livewire('project-dashboard')

    <div class="mt-4"></div>
    <hr>
</x-app-layout>