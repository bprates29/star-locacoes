<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\Car;
use App\Models\Photo;
use App\Models\Review;
use Livewire\Component;

class Detailsreviews extends Component
{
    public $review;
    public $carro;
    public $photos;
    public $src;
    public $isModalOpen = 0;

    public function mount($review_id)
    {
        $this->review = Review::find($review_id);
        $this->photos = Photo::where('review_id', $review_id)->get();
        $this->carro = Car::find($this->review->car_id);
    }

    public function render()
    {
        return view('livewire.usuarios.detailsreviews');
    }

    public function abrePhotoModal($src) {
        $this->src = $src;
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
}
