<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Gestor de usuarios</h5>
            <a id="add" href="/sales/orders/export/?{{ http_build_query(request()->except('_token', '_method')) == '' ? 'data=all' : http_build_query(request()->except('_token', '_method')) }}"
                title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>exportar</span>
            </a>
        </div>
    </div>

    {{-- /sales/orders/export/{{ http_build_query(request()->except('_token', '_method')) == '' ? 'data=all' : http_build_query(request()->except('_token', '_method')) }} --}}

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>Marca</th>
                                            <th>Vendedor</th>
                                            <th>Método de pago</th>
                                            <th>Tipo de venta</th>
                                            <th>Monto</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>{{ $order->brand_name }}</td>
                                                <td>{{ $order->user_name }}</td>
                                                <td>{{ $order->payment_method ? $order->payment_method : '- - - - - - -' }}
                                                </td>
                                                <td>{{ $order->sales_type }} </td>
                                                <td>{{ $order->total }}</td>
                                                <td>{{ $order->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
