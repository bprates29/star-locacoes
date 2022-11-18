<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Consulta extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.usuarios.consulta', [
            'users' => User::paginate(10)
        ]);
    }
}
