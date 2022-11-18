<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Carros extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.usuarios.carros', [
            'carros' => Car::where('user_id', '=', Auth::user()->id)->paginate(10)
        ]);
    }
}
