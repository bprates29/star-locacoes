<?php

namespace App\Http\Livewire\Carros;

use App\Models\Car;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Cadastro extends Component
{
    use WithPagination;

    public $isModalOpen = 0;
    public $usuarios;
    public $usuarioSelec;
    public Car $car;

    public function mount() {
        $this->car = new Car();
    }

    public function render()
    {
        $this->usuarios = User::all();
        return view('livewire.carros.cadastro', [
            'carros' => Car::paginate(10)
        ]);
    }

    protected $rules = [
        'car.placa' => 'required|string|max:7',
        'car.renavan' => 'string',
        'car.marca' => 'required|string',
        'car.data_inicio' => 'required|date_format:Y-m-d',
        'car.obs' => 'string',
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
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->car = new Car();
    }

    public function store()
    {
        $this->validate();

        $this->car->user_id = $this->usuarioSelec;
        $this->car->save();

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $this->car = Car::findOrFail($id);
        $this->usuarioSelec = $this->car->user_id;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Car::findOrFail($id)->delete();
        session()->flash('message', 'Carro excluído.');
    }

}