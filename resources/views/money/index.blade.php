<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Money In/Out') }}
            </h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMoney">
                add money
            </button>


            <!-- Modal -->
            <div class="modal fade" id="addMoney" tabindex="-1" aria-labelledby="addMoneyLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addMoneyLabel">
                                Add money
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @livewire('money.money-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="p-6 overflow-scroll bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @livewire('money.money-history')
    </div>
</x-app-layout>