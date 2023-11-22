<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Correos</h5>
            <a id="add" href="{{ route('mails.create') }}" title="Add New" type="button"
                class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>Añadir nuevo</span>
            </a>
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
                                            <th>@sortablelink('description', 'Descripción')</th>
                                            <th>@sortablelink('brand.name', 'Marca')</th>
                                            {{-- <th>driver</th>
                                            <th>host</th> --}}
                                            <th>@sortablelink('port', 'Puerto')</th>
                                            <th>@sortablelink('username', 'Usuario')</th>
                                            <th>@sortablelink('encryption','encryption')</th>
                                            <th>@sortablelink('from_address', 'From')</th>
                                            <th>@sortablelink('from_name', 'From Name')</th>
                                            <th>Acción</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mails as $mail)
                                            <tr>
                                                <td>{{ $mail->id }}</td>
                                                <td>{{ $mail->description }}</td>
                                                <td>{{ $mail->brand->name }}</td>
                                                {{-- <td>{{ $mail->driver }}</td>
                                                <td>{{ $mail->host }}</td> --}}
                                                <td>{{ $mail->port }}</td>
                                                <td>{{ $mail->username }}</td>
                                                <td>{{ $mail->encryption }}</td>
                                                <td>{{ $mail->from_address }}</td>
                                                <td>{{ $mail->from_name }}</td>
                                                <td>
                                                    <a href="{{ route('mails.edit', $mail->id) }}"
                                                        class="btn btn-primary btn-sm">Ver/Editar</a>
                                                </td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {!! $mails->appends(\Request::except('page'))->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
