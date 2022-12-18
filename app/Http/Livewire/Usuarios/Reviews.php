<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\Car;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Reviews extends Component
{

    public function mount($car_id)
    {
        $this->carro_id = $car_id;
        $this->carro = Car::find($car_id);
        $this->reviews = Review::where("car_id", $car_id)->orderBy('data', 'DESC')->get();
        if ($this->carro->user_id != Auth::user()->id) {
            $this->redirect('/');
        }
    }

    public function render()
    {
        return view('livewire.usuarios.reviews');
    }
}
