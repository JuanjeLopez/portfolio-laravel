<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $status;
    public $newimage;
    public $slider_id;


    public function mount($slider_id)
    {
        $slider = HomeSlider::find($slider_id);

        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->link = $slider->link;
        $this->status = $slider->status;
        $this->image = $slider->image;
        $this->slider_id = $slider->id;
    }


    public function updateSlide()
    {
        $slider = HomeSlider::find($this->slider_id);


        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;
        $slider->status = $this->status;

        if($this->newimage)
        {
            $imagename = Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->newimage->storeAs('sliders', $imagename);
            $slider->image = $imagename;
        }


        $slider->save();

        Session()->flash('message', 'Slide actualizado correctamente');
    }


    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout('layouts.base');
    }
}
