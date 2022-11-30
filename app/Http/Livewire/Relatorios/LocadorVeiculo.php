<?php

namespace App\Http\Livewire\Relatorios;

use App\Models\Car;
use App\Models\Contract;
use App\Models\Driver;
use Livewire\Component;
use Livewire\WithPagination;

class LocadorVeiculo extends Component
{
    use WithPagination;

    public $isModalOpen = 0;
    public $contratos;
    private $paginate = 10;

    public function mount() {

    }

    public function render()
    {
        $this->contratos = Contract::with('driver')->with('car')->whereNull('data_fim')->get();
        return view('livewire.relatorios.locador-veiculo', [
            'contratos' => $this->contratos
        ]);
    }

    public function carrosSemContratos()
    {
        $cars = Car::all()->toArray();
        $this->carrosSemContratos = array_filter($cars, function($carro){
            foreach ($this->contratos as $contrato) {
                if ($contrato->car->placa == $carro['placa']) return false;
            }
            return true;
        });
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
}
