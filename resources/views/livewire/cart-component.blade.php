<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">HOME</a></li>
                <li class="item-link"><span>Carrito</span></li>
            </ul>
        </div>
        <div class=" main-content-area">

            <div class="wrap-iten-in-cart">
                @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        {{ Session::get('success_message') }}
                    </div>
                @endif

                @if(Cart::instance('cart')->count() > 0)

                <h3 class="box-title">Nombre</h3>
                <ul class="products-cart">

                    @foreach(Cart::instance('cart')->content() as $item)

                    <li class="pr-cart-item">
                        <div class="product-image">
                            <figure><img src="{{ asset('assets/images/products') }}/{{ $item->model->image }}" alt="{{ $item->model->name }}"></figure>
                        </div>
                        <div class="product-name">
                            <a class="link-to-product" href="{{ route('product.details', ['slug'=>$item->model->slug]) }}">{{ $item->model->name }}</a>
                        </div>
                        <div class="price-field produtc-price"><p class="price">{{ $item->model->regular_price }}</p></div>
                        <div class="quantity">
                            <div class="quantity-input">
                                <input type="text" name="product-quatity" value="{{ $item->qty }}" data-max="120" pattern="[0-9]*" >
                                <a class="btn btn-increase" href="#" wire:click.prevent="increase('{{ $item->rowId }}')"></a>
                                <a class="btn btn-reduce" href="#" wire:click.prevent="decrease('{{ $item->rowId }}')"></a>
                            </div>
                            <p class='text-center'><a href="" wire:click.prevent="swichtToSaveForLater('{{ $item->rowId }}')">Guardar para más tarde</a></p>
                        </div>
                        <div class="price-field sub-total"><p class="price">{{ $item->subtotal }}</p></div>
                        <div class="delete">
                            <a href="#" class="btn btn-delete" title="" wire:click.prevent="delete('{{ $item->rowId }}')">
                                <span>Borrar del carrito</span>
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </li>

                    @endforeach

                </ul>
                @else

                    <p>No hay artículos en el carrito</p>

                @endif

            </div>

            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Resumen del pedido</h4>
                    <p class="summary-info"><span class="title">Subtotal</span><b class="index">{{ Cart::instance('cart')->subtotal() }}</b></p>
                    <p class="summary-info"><span class="title">Impuestos</span><b class="index">{{ Cart::instance('cart')->tax() }}</b></p>
                    <p class="summary-info"><span class="title">Envío</span><b class="index">¡Envío gratis! A tope</b></p>
                    <p class="summary-info total-info "><span class="title">Total</span><b class="index">{{ Cart::instance('cart')->total() }}</b></p>
                </div>
                <div class="checkout-info">
                    {{-- <label class="checkbox-field">
                        <input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
                    </label> --}}
                    <a class="btn btn-checkout" href="checkout.html">Pagar (sin funcionalidad)</a>
                </div>
                <div class="update-clear">
                    <a class="btn" href="{{ route('shop') }}">Seguir comprando <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    <a class="btn" href="#" wire:click.prevent="deleteAll()">Limpiar carrito</a>
                    <a class="btn" href="{{ route('product.cart') }}">Actualizar carrito</a>
                </div>
            </div>

            <div class="wrap-iten-in-cart">
                <h3 class='title-box' style='border-bottom: 1px solid; padding-bottom: 15px;'>{{ Cart::instance('saveForLater')->count() }} articulo(s) guardados para más tarde</h3>
                @if(Session::has('s_success_message'))
                    <div class="alert alert-success">
                        {{ Session::get('s_success_message') }}
                    </div>
                @endif

                @if(Cart::instance('saveForLater')->count() > 0)

                <h3 class="box-title">Nombre</h3>
                <ul class="products-cart">

                    @foreach(Cart::instance('saveForLater')->content() as $item)

                    <li class="pr-cart-item">
                        <div class="product-image">
                            <figure><img src="{{ asset('assets/images/products') }}/{{ $item->model->image }}" alt="{{ $item->model->name }}"></figure>
                        </div>
                        <div class="product-name">
                            <a class="link-to-product" href="{{ route('product.details', ['slug'=>$item->model->slug]) }}">{{ $item->model->name }}</a>
                        </div>
                        <div class="price-field produtc-price"><p class="price">{{ $item->model->regular_price }}</p></div>
                        <div class="quantity">

                            <p class='text-center'><a href="" wire:click.prevent="moveToCart('{{ $item->rowId }}')">Mover al carrito</a></p>
                        </div>
                        <div class="delete">
                            <a href="#" class="btn btn-delete" title="" wire:click.prevent="deleteFromSaveForLater('{{ $item->rowId }}')">
                                <span>Borrar de la lista</span>
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </li>

                    @endforeach

                </ul>
                @else

                    <p>Ningún artículo guardado para más tarde</p>

                @endif

            </div>

            @if($sproducts->count() > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now() )

            <div class="wrap-show-advance-info-box style-1 has-countdown">
                    <h3 class="title-box">Oportunidades</h3>
                    {{-- <div class="wrap-countdown mercado-countdown" data-expire={{ Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d h:m:s') }}></div> --}}
                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

                        @foreach($sproducts as $sproduct)

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('product.details', ['slug' => $sproduct->slug]) }}" title="{{ $sproduct->name }}">
                                        <figure><img src="{{ asset('assets/images/products') }}/{{ $sproduct->image }}" width="800" height="800" alt=""></figure>
                                    </a>
                                    <div class="wrap-btn">
                                        <a href="{{ route('product.details', ['slug' => $sproduct->slug]) }}" class="function-link">vistazo</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('product.details', ['slug' => $sproduct->slug]) }}" class="product-name"><span>{{ $sproduct->name }}</span></a>
                                    <div class="wrap-price"><ins><p class="product-price">{{ $sproduct->sale_price }}</p></ins> <del><p class="product-price">{{ $sproduct->regular_price }}</p></del></div>
                                </div>
                            </div>

                        @endforeach



                    </div>
                </div>
            @endif
                </div><!--End wrap-products-->
            </div>

        </div><!--end main content area-->
    </div><!--end container-->

</main>
