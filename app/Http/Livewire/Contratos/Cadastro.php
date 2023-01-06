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
    public $searchContract;
    private $paginate = 10;

    public function mount() {
        $this->contrato = new Contract();
    }

    public function render()
    {
        $this->motoristas = Driver::all();
        $this->carros = Car::all();
        return view('livewire.contratos.cadastro', [
            'contratos' => $this->contractQuery->paginate($this->paginate)
        ]);
    }

    public function getContractQueryProperty()
    {
        $searchContract = '%' . strtoupper($this->searchContract) . '%';
        return Contract::join('cars', 'car_id', '=', 'cars.id')
            ->join('users', 'cars.user_id', '=', 'users.id')
            ->join('drivers', 'driver_id', '=', 'drivers.id')
                ->where(function ($query) use ($searchContract) {
            $query->where('placa', 'like', $searchContract)
                ->orWhere('users.name', 'like', $searchContract)
                ->orWhere('drivers.name', 'like', $searchContract);
        })
            ->orderBy('placa')
            ->select('contracts.*');
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
        if ($field == 'searchContract')
        {
            $this->setPage(1);
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

        Contract::with('transfer')->findOrFail($id)->delete();
        session()->flash('message', 'Contrato excluído!');
    }
}
