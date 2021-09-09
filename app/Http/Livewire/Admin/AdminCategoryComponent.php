<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;
    public function render()
    {

        $categories = Category::paginate(10);

        return view('livewire.admin.admin-category-component', ['categories' => $categories])->layout('layouts.base');
    }

    public function deleteCategory($id){

        $category = Category::find($id);

        $category->delete();

        session()->flash('message', 'Categoría eliminada correctamente');
    }
}
