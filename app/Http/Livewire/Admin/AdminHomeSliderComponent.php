<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;

class AdminHomeSliderComponent extends Component
{

    public function deleteSlider($slider_id)
    {
        $slider = HomeSlider::find($slider_id);

        $slider->delete();

        session()->flash('message', 'Slider borrado correctamente');
    }



    public function render()
    {

        $sliders = HomeSlider::all();

        return view('livewire.admin.admin-home-slider-component', ['sliders' => $sliders])->layout('layouts.base');
    }
}
