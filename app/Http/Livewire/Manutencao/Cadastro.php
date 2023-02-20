<?php

namespace App\Http\Livewire\Manutencao;

use App\Models\Car;
use App\Models\Maintenances;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class Cadastro extends Component
{
    use WithPagination;

    public $car_id;
    public $carro;
    public $isModalOpen = 0;
    public $manutencao;
    public $manutencao_id;

    private $paginate = 10;


    public function mount($car_id)
    {
        $this->car_id = $car_id;
        $this->carro = Car::find($car_id);
    }

    public function render()
    {
        return view('livewire.manutencao.cadastro', [
        'manutencoes' => $this->Manutencoes
        ]);
    }

    public function getManutencoesProperty()
    {
        $car_id = $this->car_id;
        return Maintenances::where("car_id", $car_id)
            ->orderByDesc('data_inicial')
            ->paginate($this->paginate);
    }

    public function updated($field) {
        if ($field == 'manutencao.valor')
        {
            $this->manutencao->valor = str_replace(",",".",$this->manutencao->valor);
        }
    }

    protected $rules = [
        'manutencao.data_inicial' => 'date_format:Y-m-d',
        'manutencao.data_final' => 'nullable',
        'manutencao.valor' => 'nullable',
        'manutencao.obs' => 'nullable',
    ];

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    private function resetCreateForm()
    {
        $this->manutencao = new Maintenances();
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    public function store()
    {
        $this->validate();
        $this->manutencao->car_id = $this->car_id;
        $this->manutencao->save();

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $this->manutencao = Maintenances::findOrFail($id);
        $this->openModalPopover();
    }

    public function delete($id)
    {
        Maintenances::findOrFail($id)->delete();
        session()->flash('message', 'Manutenção excluída.');
    }
}
