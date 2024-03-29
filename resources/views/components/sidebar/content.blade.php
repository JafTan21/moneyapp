<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    @role('admin')
    <x-sidebar.link title="Admin" href="{{ route('admin') }}" :isActive="request()->routeIs('admin')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @endrole

    @can('view-money-page')
    <x-sidebar.link title="Money in/out" href="{{ route('money') }}" :isActive="request()->routeIs('money')">
    </x-sidebar.link>
    @endcan

    @can('view-projects-page')
    <x-sidebar.link title="Projects" href="{{ route('project') }}" :isActive="request()->routeIs('project')">
    </x-sidebar.link>
    @endcan

    @can('view-sub-contracts-page')
    <x-sidebar.link title="Sub Contractor" href="{{ route('sub-contractor') }}"
        :isActive="request()->routeIs('sub-contractor')">
    </x-sidebar.link>
    @endcan

    @can('view-labor-page')
    <x-sidebar.link title="Labor" href="{{ route('labor') }}" :isActive="request()->routeIs('labor')">
    </x-sidebar.link>
    @endcan

    @can('view-bill-page')
    <x-sidebar.link title="Bill" href="{{ route('bill') }}" :isActive="request()->routeIs('bill')">
    </x-sidebar.link>
    @endcan

    @can('view-supplier-page')
    <x-sidebar.link title="Supplier" href="{{ route('supplier') }}" :isActive="request()->routeIs('supplier')">
    </x-sidebar.link>
    @endcan

    @can('view-material-page')
    <x-sidebar.link title="Material" href="{{ route('material') }}" :isActive="request()->routeIs('material')">
    </x-sidebar.link>
    @endcan

    @can('view-contracted-form')
    <x-sidebar.link title="Contracted" href="{{ route('contracted') }}" :isActive="request()->routeIs('contracted')">
    </x-sidebar.link>
    @endcan

</x-perfect-scrollbar>