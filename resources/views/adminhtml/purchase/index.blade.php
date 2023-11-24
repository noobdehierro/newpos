<x-app-layout>
    @if (!empty($infoMsg))
        <x-flash type="warning" dismiss="yes">{{ $infoMsg }}</x-flash>
    @endif
    @push('meta')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    <div class="card">
        <div class="card-header top-card">
            <h5>Registro de información</h5>
        </div>
    </div>

    @if ($order)
        <div class="main-body">
            <div class="page-wrapper">
                <!-- [ Main Content ] start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="float-left">Tiene una solicitud pendiente de pago</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a class="btn btn-primary"
                                            href="{{ route('purchase.create', $order->id) }}">Continuar</a>
                                        <x-form action="{{ route('purchase.update', $order->id) }}" method="PATCH"
                                            style="display: inline-block">
                                            <x-confirm id="purchase-alert" action="Cancelar orden">¿Esta seguro de
                                                cancelar esta orden?</x-confirm>
                                        </x-form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="mt-1 mb-3">Cliente</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="text-dark">
                                            <td>Nombre</td>
                                            <td>:</td>
                                            <td>{{ $order->name . ' ' . $order->lastname }}</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td>Correo electrónico</td>
                                            <td>:</td>
                                            <td>{{ $order->email }}</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td>Teléfono</td>
                                            <td>:</td>
                                            <td>{{ $order->telephone }}</td>
                                        </tr>
                                        @if ($order->birday)
                                            <tr class="text-dark">
                                                <td>Fecha de nacimiento</td>
                                                <td>:</td>
                                                <td>{{ $order->birday }}</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="mt-1 mb-3">Dirección</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="text-dark">
                                            <td>Calle y numero</td>
                                            <td>:</td>
                                            <td>{{ $order->street . ' ' . $order->outdoor . ' ' . $order->indoor }}</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td>Colonia y municipio</td>
                                            <td>:</td>
                                            <td>{{ $order->suburb . ' ' . $order->city }}</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td>C.P. y estado</td>
                                            <td>:</td>
                                            <td>{{ $order->postcode . ' ' . $order->region }}</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td>Referencias</td>
                                            <td>:</td>
                                            <td>{{ $order->references }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="mt-1 mb-3">SIM</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        @if ($order->imei)
                                            <tr class="text-dark">
                                                <td>IMEI</td>
                                                <td>:</td>
                                                <td>{{ $order->imei }}</td>
                                            </tr>
                                        @endif
                                        <tr class="text-dark">
                                            <td>ICCID</td>
                                            <td>:</td>
                                            <td>{{ $order->iccid }}</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td>Marca</td>
                                            <td>:</td>
                                            <td>{{ $order->brand->name }}</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td>Canal</td>
                                            <td>:</td>
                                            <td>{{ $order->channel }}</td>
                                        </tr </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="mt-1 mb-3">Producto</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="text-dark">
                                            <td>Método de pago</td>
                                            <td>:</td>
                                            <td class="text-c-blue">{{ $order->payment_method }}</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td>ID</td>
                                            <td>:</td>
                                            <td>{{ $order->qv_offering_id }}</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td>Fecha de operación</td>
                                            <td>:</td>
                                            <td>{{ $order->created_at }}</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td>Total</td>
                                            <td>:</td>
                                            <td>{{ $order->total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    @else
        <div class="main-body">
            <div class="page-wrapper">
                <!-- [ Main Content ] start -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card user-list">
                            <div class="card-block pb-0">
                                <x-form action="{{ route('purchase.store') }}">
                                    <x-slot name="rules">
                                        {
                                        telephone: {minlength: 10},
                                        iccid: {minlength: 7, maxlength: 7},
                                        imei: {minlength: 15},
                                        postcode: {minlength: 5},
                                        nip: {minlength: 4},
                                        msisdn: {minlength: 10},
                                        msisdn_temp: {minlength: 10}
                                        }
                                    </x-slot>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mt-1 mb-3">Compatibilidad</h5>
                                            <x-flash type="info" dismiss="yes">
                                                <p class="font-weight-bold">Hay tres maneras de obtener tu IMEI</p>
                                                <ul>
                                                    <li>Marca *#06# desde el teléfono celular a revisar.</li>
                                                    <li>Búscalo en la configuración del teléfono celular, son entre 15 y
                                                        17
                                                        números</li>
                                                    <li>Encuéntralo impreso en la etiqueta de la batería del teléfono
                                                        celular</li>
                                                </ul>
                                            </x-flash>
                                            <x-form-input name="imei" size="m">IMEI</x-form-input>
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="mt-1 mb-3 border-b-2">Datos personales</h5>
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <x-form-input name="status" type="hidden"
                                                    value="Pending"></x-form-input>
                                                <x-form-input name="sales_type" type="hidden" value="Contratación">
                                                </x-form-input>
                                                <x-form-input name="user_id" type="hidden"
                                                    value="{{ auth()->user()->id }}"></x-form-input>
                                                <x-form-input name="user_name" type="hidden"
                                                    value="{{ auth()->user()->name }}"></x-form-input>
                                                <x-form-input name="brand_id" type="hidden"
                                                    value="{{ auth()->user()->brand_id }}"></x-form-input>
                                                <x-form-input name="channel" type="hidden"
                                                    value="POS"></x-form-input>
                                                <x-form-input name="name" required="true" size="m">Nombre
                                                </x-form-input>
                                                <x-form-input name="lastname" required="true"
                                                    size="m">Apellidos
                                                </x-form-input>
                                                <x-form-input name="email" required="true" type="email"
                                                    size="s">
                                                    Correo electrónico</x-form-input>
                                                <x-form-input name="telephone" required="true"
                                                    size="s">Teléfono
                                                </x-form-input>
                                                <x-form-input name="birday" type="date" size="s">Fecha de
                                                    nacimiento</x-form-input>
                                                <div class="iccidContainer">
                                                    <span class="m-t-15">{{ $iccid_prefix }}</span>
                                                    <x-form-input name="iccid" required="true" type="tel"
                                                        minlenght="8" maxlenght="8"
                                                        size="m">ICCID</x-form-input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="mt-1 mb-3">Dirección</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <x-form-input name="street" required="true" size="m">Calle
                                                </x-form-input>
                                                <x-form-input name="outdoor" required="true" size="xs">No.
                                                    exterior
                                                </x-form-input>
                                                <x-form-input name="indoor" size="xs">No.
                                                    interior</x-form-input>
                                                <x-form-input name="references" required="true"
                                                    size="m">Referencias
                                                </x-form-input>
                                                <x-form-input name="postcode" required="true" size="xs">Código
                                                    postal
                                                </x-form-input>
                                                {{-- <x-form-input name="suburb" required="true" size="xs">Colonia</x-form-input> --}}
                                                <x-form-select name="suburb" required="true" size="xs">
                                                </x-form-select>
                                                <x-form-input name="city" required="true" size="xs">Municipio
                                                </x-form-input>
                                                <x-form-input name="region" required="true" size="xs">Estado
                                                </x-form-input>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="mt-1 mb-3">Portabilidad</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <x-form-switch name="portabilidad" checked="0">Requiere portabilidad
                                            </x-form-switch>

                                            <div id="pannel_portabilidad" class="pannel">
                                                <x-flash type="info" dismiss="yes">
                                                    <p class="font-weight-bold">Hay dos formas de obtener tu NIP</p>
                                                    <ul>
                                                        <li>Envia un SMS al 051 con la palabra NIP, llama al 051 desde
                                                            el
                                                            SIM de tu telefonía anterior</li>
                                                        <li>Llama al 051 desde el SIM de tu telefonía anterior</li>
                                                    </ul>
                                                </x-flash>
                                                <div class="row">
                                                    <x-form-input name="nip" size="s">NIP</x-form-input>
                                                    <x-form-input name="msisdn" required="true"
                                                        size="s">Número a
                                                        portar</x-form-input>

                                                </div>
                                            </div>
                                            <script>
                                                $(function() {
                                                    $('#portabilidad').on('change', function() {
                                                        if ($('#portabilidad').prop('checked')) {
                                                            $('#pannel_portabilidad').show();
                                                        } else {
                                                            $('#pannel_portabilidad').hide();
                                                        }
                                                    });
                                                });

                                                $(function() {
                                                    $('#postcode').focusout(function() {
                                                        var postcode = $('#postcode').val();

                                                        $.ajax({
                                                            url: '{{ route('copomex.create') }}',
                                                            type: 'POST',
                                                            data: {
                                                                postcode: postcode
                                                            },
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            },
                                                            success: function(data) {

                                                                console.log(data);

                                                                if (!data.error) {
                                                                    $("#suburb").children().remove();
                                                                    $.each(data, function(key, value) {
                                                                        $("#suburb").append(
                                                                            '<option value="' +
                                                                            value.response.asentamiento +
                                                                            '">' +
                                                                            value.response.asentamiento +
                                                                            "</option>"
                                                                        );
                                                                    });
                                                                    $("#city").val(data[0].response.municipio);
                                                                    $("#region").val(data[0].response.estado);
                                                                } else {
                                                                    $("#postcode").val("");
                                                                    $("#city").val("");
                                                                    $("#region").val("");
                                                                    $("#suburb").children().remove();
                                                                    console.log("error");
                                                                }
                                                            },
                                                            error: function(data) {
                                                                // alert('codigo postal no encontrado');
                                                                // $('#postcode').val('');
                                                                // $('#city').val('');
                                                                // $('#region').val('');
                                                                // $('#suburb').children().remove();
                                                                console.log(data);

                                                            }

                                                        });
                                                    });
                                                });

                                                $(function() {

                                                    $('#imei').focusout(function() {

                                                        $.ajax({
                                                            url: '{{ route('compatibility.checkImei') }}',
                                                            type: 'POST',
                                                            data: {
                                                                imei: $('#imei').val()
                                                            },
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            },
                                                            success: function(data) {
                                                                // console.log(data);

                                                                // Verifica si deviceFeatures está definido y no es null
                                                                if (data.deviceFeatures && data.deviceFeatures.band28 !== undefined) {
                                                                    var band28 = data.deviceFeatures.band28 ? 'SI' : 'NO';

                                                                    if (band28 == 'SI') {
                                                                        $('#imei').next().remove();
                                                                        $('#imei').after(
                                                                            '<div class="alert alert-success mt-1" role="alert">' +
                                                                            '<strong>¡Felicidades!</strong> El número de IMEI es compatible con el servicio.' +
                                                                            '</div>'
                                                                        );
                                                                    } else {
                                                                        $('#imei').next().remove();
                                                                        $('#imei').after(
                                                                            '<div class="alert alert-danger mt-1" role="alert">' +
                                                                            '<strong>¡Error!</strong> El número de IMEI no es compatible con el servicio.' +
                                                                            '</div>'
                                                                        );
                                                                    }
                                                                } else {
                                                                    $('#imei').next().remove();
                                                                    $('#imei').after(
                                                                        '<div class="alert alert-danger mt-1" role="alert">' +
                                                                        '<strong>¡Error!</strong> El número de IMEI no es compatible con el servicio.' +
                                                                        '</div>'
                                                                    );
                                                                }
                                                            },

                                                            error: function(data) {
                                                                console.log(data);

                                                            }
                                                        });
                                                    });

                                                });
                                            </script>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn  btn-primary" type="submit">Siguiente</button>
                                            <a class="btn btn-light"
                                                href="{{ route('purchase.index') }}">Regresar</a>
                                        </div>
                                    </div>
                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    @endif


</x-app-layout>
