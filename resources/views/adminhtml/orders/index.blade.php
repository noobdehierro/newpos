<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Ordenes</h5>
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@sortablelink('id', '#')</th>
                                        @brandAdmin
                                            <th>@sortablelink('brand_name','Marca')</th>
                                        @endbrandAdmin
                                        <th>@sortablelink('name','Cliente')</th>
                                        <th>@sortablelink('user_name','Vendedor')</th>
                                        <th>@sortablelink('msisdn','MSISDN')</th>
                                        <th>@sortablelink('sales_type','Tipo de venta')</th>
                                        <th>@sortablelink('payment_method','Método de pago')</th>
                                        <th>@sortablelink('status','Estatus')</th>
                                        <th>@sortablelink('total','Total')</th>
                                        <th>@sortablelink('created_at','Fecha')</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            @brandAdmin
                                                <td>{{ $order->brand_name }}</td>
                                            @endbrandAdmin
                                            <td>{{ $order->name }} {{ $order->lastname }}</td>
                                            <td>{{ $order->user_name }}</td>
                                            <td>{{ $order->msisdn }}</td>
                                            <td>{{ $order->sales_type }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td class="@if ($order->status == 'Complete')text-c-green @elseif($order->status == 'Canceled') text-c-red @else text-c-yellow @endif">{{ $order->status }}</td>
                                            <td>{{ $order->total }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">Ver/Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {!! $orders->appends(\Request::except('page'))->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
