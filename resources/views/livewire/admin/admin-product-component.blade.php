<div>
    <div class="container" style='padding: 30px 0;'>
        <div class="row">
            <div class="column-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                TODOS LOS PRODUCTOS
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.addproduct') }}" class='btn btn-success pull-right'>Añadir producto</a>
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
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
                                    <th>Rebaja</th>
                                    <th>Categoría</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><img src="{{ asset('assets/images/products') }}/{{ $product->image }}" width='60'></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->stock_status }}</td>
                                        <td>{{ $product->regular_price }}</td>
                                        <td>{{ $product->sale_price }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.editproduct', ['product_slug' => $product->slug]) }}"><i class='fa fa-edit fa-2x text-info'></i></a>
                                            <a href="" onclick="confirm('¿Estás seguro de querer elimiar este producto?') || event.stopImmediatePropagation()" wire:click.prevent='deleteProduct({{ $product->id }})' style='margin-lef: 10px;'><i class='fa fa-times fa-2x text-danger'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
