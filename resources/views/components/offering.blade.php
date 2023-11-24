@props([
    'id' => '',
    'brand' => '',
    'action' => 'Ver/Editar',
    'action_route' => 'default',
    'qv_offering_id' => '',
])

{{-- @php
    $selectButton = true;
    if ($action_route === 'default') {
        $action_route = route('offerings.edit', $id);
        $selectButton = false;
    }
@endphp --}}



<div class="col-md-3 col-xs-12">
    <x-form action="{{ route('purchase.store') }}">

        <div class="card offering-card">
            <div class="card-header">
                <h5>{{ $name }}</h5>
                <x-form-input name="offering_name" type="hidden" value="{{ $name }}"></x-form-input>
                <div class="offering-price">
                    ${{ $price }} MXN
                </div>
                <x-form-input name="total" type="hidden" value="{{ $price }}"></x-form-input>
                <div>{{ $brand }}</div>
            </div>
            <div class="card-body">
                <div class="offering-description">
                    {{ $description }}
                </div>
                <x-form-input name="offering_description" type="hidden" value="{{ $description }}"></x-form-input>
            </div>

            <div class="card-footer">
                <a href="{{ $action_route }}" data-id="{{ $qv_offering_id }}"
                    class="btn shadow-1 btn-primary offering-select">{{ $action }}</a>
            </div>
        </div>
    </x-form>

</div>
