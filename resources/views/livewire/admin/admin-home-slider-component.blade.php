<div>
    <div class="container" style='padding: 30px 0;'>
        <div class="row">
            <div class="column-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                SLIDERS
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.addhomeslider') }}" class='btn btn-success pull-right'>Añadir slider</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success text-center" role='alert'>{{ Session::get('message') }}</div>
                        @endif
                        <table class='table table-striped'>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Título</th>
                                    <th>Subtítulo</th>
                                    <th>Precio</th>
                                    <th>Link</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td>{{ $slider->id }} </td>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->subtitle }}</td>
                                        <td>{{ $slider->price }}</td>
                                        <td>{{ $slider->link }}</td>
                                        <td>
                                            <img src="{{ asset('assets/images/sliders') }}/{{ $slider->image }}" width='120'>
                                        </td>
                                        <td>{{ $slider->status === 1 ? 'Active' : 'Inactive'}}</td>
                                        <td>{{ $slider->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.edithomeslider', ['slider_id' => $slider->id]) }}"><i class='fa fa-edit fa-2x text-info'></i></a></a>
                                            <a href="#" wire:click.prevent="deleteSlider({{ $slider->id }})"><i class='fa fa-times fa-2x text-danger'></i></a></a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
