<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CadastroCarros extends Component
{
    public $contador = 0;
    public $placa;
    public $carros = [1,2,3,4,5,6,7,8];


    public $title;
    public $content;

    protected $rules = [
        'title' => 'required|string|min:6',
        'content' => 'required|string|max:500',
    ];

    public function save()
    {
        $this->validate();
    }

    public function mount() {

    }


    public function render()
    {
        return view('livewire.cadastro-carros');
    }

    public function incrementar() {
        $this->contador++;
    }

    public function salvar() {
        dd($this->placa);
    }
}
