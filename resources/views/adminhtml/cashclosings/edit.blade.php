<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Corte de caja</h5> <span class="font-weight-bold">saldo pendiente <span
                    class="badge badge-primary">{{ $amount }}</span></span>
        </div>
    </div>
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('cash-closings.update', $id) }}" method="PUT">
                                <div class="row">
                                    <x-form-input name="amount" required="true" size="s" type="number">Monto a
                                        abonar</x-form-input><br />
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn  btn-primary" type="submit">Abonar</button>
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
</x-app-layout>
