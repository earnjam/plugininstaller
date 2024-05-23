<x-container>
    @php
        ray()->showHttpClientRequests();
    @endphp
    <livewire:installer :site="$site"/>
</x-container>
