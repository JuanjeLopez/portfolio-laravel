<?php

namespace App\Http\Livewire;

use Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoryComponent extends Component
{

    public $sorting;
    public $pagesize;
    public $category_slug;

    use WithPagination;
    public function render()
    {

        $category = Category::where('slug', $this->category_slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;

        // Ordenar por
        if($this->sorting === 'date')
        {
            $products = Product::where('category_id', $category->id)->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        }
        else if($this->sorting === 'price')
        {
            $products = Product::where('category_id', $category->id)->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        }
        else if($this->sorting === 'price-desc')
        {
            $products = Product::where('category_id', $category->id)->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        }
        else{
            $products = Product::where('category_id', $category->id)->paginate($this->pagesize);
        }

        // Mostrar categorías
        $categories = Category::all();


        //Vista final
        return view('livewire.category-component', ['products' => $products, 'categories' => $categories, 'category_name' => $category_name])->layout('layouts.base');
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');

        session()->flash('success_message', 'Item added in cart');

        return redirect()->route('product.cart');
    }

    public function mount($category_slug)
    {
        $this->sorting = 'default';
        $this->pagesize = 12;
        $this->category_slug = $category_slug;
    }

}
