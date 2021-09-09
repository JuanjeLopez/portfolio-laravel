<div>
    <div class="container" style='padding: 30px 0;'>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                EDITAR PRODCUTO
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.products') }}" class='btn btn-success pull-right'>TODOS LOS PRODUCTOS</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success text-center" role='alert'>{{ Session::get('message') }}</div>
                        @endif

                        <form class='form-horizontal' enctype='multipart/form-data' wire:submit.prevent='updateProduct'>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Nombre</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder='Nombre' class='form-control input-md' wire:model='name' wire:keyup='generateSlug'>
                                    @error('name') <p class='text-danger'>{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Slug</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder='Slug' class='form-control input-md' wire:model='slug'>
                                    @error('slug') <p class='text-danger'>{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Descripción breve</label>
                                <div class="col-md-4" wire:ignore>
                                    <textarea class='form-control' id='short_description' placeholder='Descripción breve' wire:model='short_description'></textarea>
                                    @error('short_description') <p class='text-danger'>{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Descripción</label>
                                <div class="col-md-4" wire:ignore>
                                    <textarea class='form-control' id='description' placeholder='Descripción' wire:model='description'></textarea>
                                    @error('description') <p class='text-danger'>{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Precio normal</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder='Precio normal' class='form-control input-md' wire:model='regular_price'>
                                    @error('regular_price') <p class='text-danger'>{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Precio en oferta</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder='Precio en oferta' class='form-control input-md' wire:model='sale_price'>
                                    @error('sale_price') <p class='text-danger'>{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>SKU</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder='SKU' class='form-control input-md' wire:model='SKU'>
                                    @error('SKU') <p class='text-danger'>{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Stock</label>
                                <div class="col-md-4">
                                   <select class='form-control' wire:model='stock_status'>
                                       <option value='instock'>Con stock</option>
                                       <option value='outofstock'>Sin stock</option>
                                   </select>
                                   @error('stock_status') <p class='text-danger'>{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Destacado</label>
                                <div class="col-md-4">
                                   <select class='form-control' wire:model='featured'>
                                       <option value='1'>Sí</option>
                                       <option value='0'>No</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Cantidad</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder='Cantidad' class='form-control input-md' wire:model='quantity'>
                                    @error('quantity') <p class='text-danger'>{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Nueva Imagen</label>
                                <div class="col-md-4">
                                    <input type="file" class='input-file' wire:model='newimage'>
                                    @if($newimage)
                                        <img src='{{ $newimage->temporaryUrl() }}' width='120'>
                                    @else
                                        <img src="{{ asset('assets/images/products') }}/{{ $image }}" width='120'>
                                    @endif
                                    @error('newimage') <p class='text-danger'>{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class='col-md-4 control-label'>Categoría</label>
                                <div class="col-md-4">
                                   <select class='form-control' wire:model='category_id'>
                                        <option value=''>Seleccionar categoría</option>
                                        @foreach($categories as $category)
                                            <option value='{{ $category->id }}'>{{ $category->name }}</option>
                                        @endforeach
                                   </select>
                                   @error('category_id') <p class='text-danger'>{{ $message }}</p>@enderror
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

@push('scripts')
    <script>
        $(function(){
            tinymce.init({
                selector: '#short_description',
                setup: function(editor){
                    editor.on('Change', function(e){
                        tinyMCE.triggerSave();

                        var sd_data = $('#short_description').val();
                        @this.set('short_description', sd_data);
                    })
                }
            })

            tinymce.init({
                selector: '#description',
                setup: function(editor){
                    editor.on('Change', function(e){
                        tinyMCE.triggerSave();

                        var d_data = $('#description').val();
                        @this.set('description', d_data);
                    })
                }
            })
        });
    </script>


@endpush

