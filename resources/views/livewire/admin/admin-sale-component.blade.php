<div class="container" style='padding: 30px;'>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    CONFIGURACIÓN DE OFERTAS
                </div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success text-center" role='alert'>{{ Session::get('message') }}</div>
                    @endif
                    <form class="form-horizontal" wire:submit.prevent='updateSale'>
                        <div class="form-group">
                            <label class='col-md-4 control-label'>Estado</label>
                            <div class="col-md-4">

                                <select class='form-control' wire:model='status'>
                                    <option value="0">Inactiva</option>
                                    <option value="1">Activa</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class='col-md-4 control-label'>Fecha de oferta</label>
                            <div class="col-md-4">

                                <input type="text" id='sale-date' placeholder="Selecciona fecha y hora" class='form-control input-md' wire:model='sale_date'>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">

                                <button type='submit' class='btn btn-primary'>Actualizar</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        $(function(){
            $('#sale-date').datetimepicker({
                format : 'Y-MM-DD h:m:s',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    previous: "fa fa-chevron-left",
                    next: "fa fa-chevron-right",
                    today: "fa fa-clock-o",
                    clear: "fa fa-trash-o"
                }
            })
            .on('dp.hide', function (ev) {
                var data = $('#sale-date').val();
                @this.set('sale_date', data);
                });
            });
    </script>

@endpush
