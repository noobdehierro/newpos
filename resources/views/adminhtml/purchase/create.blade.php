<x-app-layout>
    @if (!empty($infoMsg))
        <x-flash type="warning" dismiss="yes">{{ $infoMsg }}</x-flash>
    @endif
    <div class="card">
        <div class="card-header top-card">
            <h5>Contratación</h5>
        </div>
    </div>
    <div class="pannel active" id="offering">
        <div class="row">
            @foreach ($offerings as $offering)
                {{-- {{ $offering['specialPrice'] }} --}}
                <x-offering id="{{ $offering['offering_id'] }}" brand="{{ auth()->user()->brand->name }}"
                    action="Seleccionar" orderId="{{ $order->id }}">
                    <x-slot name="name">{{ $offering['display_name'] }}</x-slot>
                    <x-slot name="price">{{ $offering['specialPrice'] }}</x-slot>
                    <x-slot name="msisdn">{{ $msisdn }}</x-slot>

                    {{-- <x-slot name="seller_price">{{ $offering->seller_price }}</x-slot> --}}
                    <x-slot name="description">
                        {!! $offering['description'] !!}
                    </x-slot>
                    {{-- <x-slot name="action_route">{{ route('purchase.payment', $order->id) }}</x-slot> --}}
                </x-offering>
            @endforeach
        </div>
    </div>
</x-app-layout>
