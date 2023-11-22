<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Nueva cuenta</h5>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('accounts.store') }}" enctype="multipart/form-data">
                                @admin
                                    <div class="row">
                                        <x-form-select name="user_id" label="Usuario" size="s" required="true">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </x-form-select>
                                    </div>
                                @endadmin
                                @super
                                <div class="row">
                                    <x-form-select name="brand_id" label="Marca" size="s" required="true">
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </x-form-select>
                                </div>
                                @else
                                    <input type="hidden" name="brand_id" value="{{ auth()->user()->primary_brand_id }}" />
                                @endsuper
                                <div class="row">
                                    <x-form-input name="name" size="s">Nombre</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="amount" size="s" readonly="true" value="0" group="$">Saldo disponible</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-switch name="is_active" checked="true" size="s">Activo</x-form-switch>
                                </div>
                                <div class="row">
                                    <button class="btn  btn-primary" type="submit">Guardar</button>
                                    <a class="btn btn-light" href="{{ route('accounts.index') }}">Cancelar</a>
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
