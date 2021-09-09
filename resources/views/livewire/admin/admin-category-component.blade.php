<div class="container" style='padding: 30px;'>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>TODAS LAS CATEGORÍAS</strong>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.addcategory') }}" class='btn btn-success pull-right'>Añadir categoría</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success text-center" role='alert'>{{ Session::get('message') }}</div>
                    @endif
                    <table class='table table.striped'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.editcategory', ['category_slug' => $category->slug]) }}"><i class='fa fa-edit fa-2x'></i></a>
                                        <a href="#" onclick="confirm('¿Estás seguro de querer elimiar esta categoría?') || event.stopImmediatePropagation()" wire:click.prevent='deleteCategory({{ $category->id }})' style='margin-lef: 10px;'><i class='fa fa-times fa-2x text-danger'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="wrap-pagination-info">
                        {{ $categories->links() }}
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>


