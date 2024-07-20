<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            @include('card.card-data')
            <div class="group-chart flex gap-8 justify-center">
                @include('chart.booking')
                @include('chart.product')
            </div>
            <div class="line-chart flex gap-8 justify-center">
                @include('chart.booking-field')
                @include('chart.field-chart')
            </div>
        </main>
    </div>
</x-app-layout>
