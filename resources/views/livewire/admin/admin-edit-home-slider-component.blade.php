<div>
    <div class="container" style='padding: 30px 0;'>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                EDITAR SLIDE
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.homesliders') }}" class='btn btn-success pull-right'>TODOS LOS SLIDERS</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success text-center" role='alert'>{{ Session::get('message') }}</div>
                        @endif

                        <form class='form-horizontal' enctype='multipart/form-data' wire:submit.prevent='updateSlide'>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Título</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder='Título' class='form-control input-md' wire:model='title'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Subtítulo</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder='Subtítulo' class='form-control input-md' wire:model='subtitle'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Precio</label>
                                <div class="col-md-4">
                                    <input class='form-control' placeholder='Precio' wire:model='price'></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Link</label>
                                <div class="col-md-4">
                                    <input class='form-control' placeholder='Enlace' wire:model='link'></input>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class='col-md-4 control-label'>Estado</label>
                                <div class="col-md-4">
                                   <select class='form-control' wire:model='status'>
                                       <option value='0'>Inactivo</option>
                                       <option value='1'>Activo</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Imagen</label>
                                <div class="col-md-4">
                                    <input type="file" class='input-file' wire:model='newimage'>
                                    @if($newimage)
                                        <img src="{{ $newimage->temporaryUrl() }}" width='120'>
                                    {{-- @else
                                        <img src="{{ asset('assets/images/sliders') }}/{{ $image }}" width='120'> --}}
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label class='col-md-4 control-label'></label>
                                <div class="col-md-4">
                                    <button type='submit' class='btn btn-primary'>ACTUALIZAR</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
