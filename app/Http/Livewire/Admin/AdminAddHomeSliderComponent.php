<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminAddHomeSliderComponent extends Component
{

    use WithFileUploads;

    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $status;
    public $image;


    public function mount()
    {
        $this->status = 0;
    }

    public function addslide()
    {
        $slider = new HomeSlider();

        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;
        $slider->status = $this->status;

        $imagename = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('sliders', $imagename);

        $slider->image = $imagename;

        $slider->save();

        session()->flash('message', 'Slide creado correctamente');
    }



    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component')->layout('layouts.base');
    }
}
