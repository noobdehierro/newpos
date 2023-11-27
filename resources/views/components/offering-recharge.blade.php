@props([
    'id' => '',
    'orderId' => 'no hay',
    'brand' => '',
    'action' => 'Ver/Editar',
    'action_route' => 'default',
    'qv_offering_id' => '',
])


<div class="col-md-3 col-xs-12">
    <x-form action="{{ route('recharges.store') }}">

        <div class="card offering-card">
            <div class="card-header">
                <x-form-input name="offering_id" type="hidden" value="{{ $id }}"></x-form-input>
                <h5>{{ $name }}</h5>
                <x-form-input name="offering_name" type="hidden" value="{{ $name }}"></x-form-input>
                <div class="offering-price">
                    ${{ $price }} MXN
                </div>
                <x-form-input name="total" type="hidden" value="{{ $price }}"></x-form-input>
                <x-form-input name="msisdn" type="hidden" value="{{ $msisdn }}"></x-form-input>
                <div>{{ $brand }}</div>
            </div>
            <div class="card-body">
                <div class="offering-description">
                    {{ $description }}
                </div>
                <x-form-input name="offering_description" type="hidden" value="{{ $description }}"></x-form-input>
            </div>

            <div class="card-footer">
                <button class="btn shadow-1 btn-primary offering-select" type="submit">{{ $action }}</button>

            </div>
        </div>
    </x-form>

</div>
