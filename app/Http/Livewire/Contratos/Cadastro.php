<?php

namespace App\Http\Livewire\Contratos;

use App\Models\Car;
use App\Models\Contract;
use App\Models\Driver;
use Livewire\Component;
use Livewire\WithPagination;

class Cadastro extends Component
{
    use WithPagination;

    public $isModalOpen = 0;
    public $motoristas;
    public $carros;
    public $motoristaSelec;
    public $carroSelec;
    public Contract $contrato;

    public function mount() {
        $this->contrato = new Contract();
    }

    public function render()
    {
        $this->motoristas = Driver::all();
        $this->carros = Car::all();
        return view('livewire.contratos.cadastro', [
            'contratos' => Contract::paginate(10)
        ]);
    }

    protected $rules = [
        'contrato.data_inicio' => 'required|date_format:Y-m-d',
        'contrato.valor_diario' => 'required|numeric',
        'contrato.data_fim' => 'nullable|date_format:Y-m-d',
        'contrato.obs' => 'nullable|string',
    ];

    public function updated($field) {
        if ($field == 'contrato.valor_diario')
        {
            $this->contrato->valor_diario = str_replace(",",".",$this->contrato->valor_diario);
        }
    }

    public function create()
    {
        $this->resetCreateForm();
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
    private function resetCreateForm(){
        $this->motoristaSelec = '';
        $this->carroSelec = '';
        $this->contrato = new Contract();
    }

    public function store()
    {
        $this->validate();

        $this->contrato->car_id = $this->carroSelec;
        $this->contrato->driver_id = $this->motoristaSelec;
        $this->contrato->save();

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $this->contrato = Contract::findOrFail($id);
        $this->motoristaSelec = $this->contrato->driver_id;
        $this->carroSelec = $this->contrato->car_id;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Contract::findOrFail($id)->delete();
        session()->flash('message', 'Contrato excluído!');
    }
}
