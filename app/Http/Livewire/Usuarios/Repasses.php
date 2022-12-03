<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\Car;
use App\Models\Transfer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Repasses extends Component
{
    use WithPagination;

    public $carro;
    public $carro_id;
    public $paginate = 10;

    public function mount($id)
    {
        $this->carro_id = $id;
        $this->carro = Car::find($id);
    }

    public function render()
    {
        return view('livewire.usuarios.repasses', [
            'repasses' => $this->repasses, 'totalRepasses' => $this->totalRepasses
        ]);
    }

    public function getRepassesProperty()
    {
        $car_id = $this->carro_id;
        return Transfer::whereHas('contract', function($q) use ($car_id) {
            $q->where('car_id', '=', $car_id);
            })
            ->orderByDesc('data_recebimento')
            ->paginate($this->paginate);
    }

    public function getTotalRepassesProperty() {
        return Transfer::join('contracts', 'contracts.id', '=', 'transfers.contract_id')
            ->join('cars', 'cars.id', '=', 'contracts.car_id')
            ->where('cars.id', $this->carro_id)->sum('valor_repasse');
    }
}
