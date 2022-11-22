<?php

namespace App\Http\Livewire\Motoristas;

use App\Models\Driver;
use Livewire\Component;
use Livewire\WithPagination;
use Manny\Manny;

class Cadastro extends Component
{
    use WithPagination;

    public $isModalOpen = 0;
    public Driver $motorista;
    public $searchDriver;
    private $paginate = 10;

    public function mount() {
        $this->motorista = new Driver();
    }

    public function render()
    {
        return view('livewire.motoristas.cadastro', [
        'motoristas' => $this->driverQuery->paginate($this->paginate)
        ]);
    }

    public function getDriverQueryProperty()
    {
        $searchDriver = '%' . strtoupper($this->searchDriver) . '%';
        return Driver::where(function ($query) use ($searchDriver) {
            $query->where('name', 'like', $searchDriver)
                ->orWhere('cpf', 'like', $searchDriver);
        })
            ->orderBy('name');
    }

    protected $rules = [
        'motorista.name' => 'required|string',
        'motorista.cpf' => 'required|string',
        'motorista.cnh' => 'nullable|string',
        'motorista.telefone' => 'nullable|string',
        'motorista.obs' => 'nullable|string',
    ];

    public function updated($field)
    {
        if ($field == 'motorista.telefone')
        {
            $this->motorista->telefone = Manny::mask($this->motorista->telefone, "(11) 11111-1111");
        }
        if ($field == 'motorista.cpf')
        {
            $this->motorista->cpf = Manny::mask($this->motorista->cpf, "111.111.111-11");
        }
        if ($field == 'searchDriver')
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
        $this->motorista = new Driver();
    }

    public function store()
    {
        $this->validate();
        $this->motorista->save();

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $this->motorista = Driver::findOrFail($id);

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Driver::findOrFail($id)->delete();
        session()->flash('message', 'Motorista excluído!');
    }


}
