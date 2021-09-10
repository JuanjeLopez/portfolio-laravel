<?php




namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use Cart;

class CartComponent extends Component
{


    public function increase($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);

        $qty = $product->qty + 1;

        Cart::instance('cart')->update($rowId, $qty);

        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function decrease($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);

        $qty = $product->qty - 1;

        Cart::instance('cart')->update($rowId, $qty);

        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function delete($rowId)
    {
        Cart::instance('cart')->remove($rowId);

        $this->emitTo('cart-count-component', 'refreshComponent');

        session()->flash('success_message', 'Artículo eliminado del carrito');


    }

    public function deleteAll()
    {
        Cart::instance('cart')->destroy();

        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function swichtToSaveForLater($rowId)
    {
        $item = Cart:: instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');

        $this->emitTo('cart-count-component', 'refreshComponent');

        session()->flash('success_message', 'El artículo se ha guardado para más tarde');
    }


    public function moveToCart($rowId)
    {
        $item = Cart:: instance('saveForLater')->get($rowId);
        Cart::instance('saveForLater')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');

        $this->emitTo('cart-count-component', 'refreshComponent');

        session()->flash('s_success_message', 'El artículo se ha movido al carrito');
    }


    public function deleteFromSaveForLater($rowId)
    {
        Cart::instance('saveForLater')->remove($rowId);

        session()->flash('s_success_message', 'Artículo eliminado de la lista');
    }

    public function render()
    {

        $sproducts = Product::where('sale_price', '>', 0)->inRandomOrder()->get()->take(8);
        $sale = Sale::find(1);

        return view('livewire.cart-component', [
            'sproducts' => $sproducts,
            'sale' => $sale,
        ])->layout('layouts.base');
    }

}
