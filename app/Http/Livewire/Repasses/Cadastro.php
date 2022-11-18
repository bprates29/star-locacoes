<?php

namespace App\Http\Livewire\Repasses;

use App\Models\Contract;
use App\Models\Transfer;
use Livewire\Component;
use Livewire\WithPagination;

class Cadastro extends Component
{
    use WithPagination;

    public $contrato_id;
    public $repasse;
    public $isModalOpen = 0;

    protected $rules = [
        'repasse.data_repasse' => 'nullable|date_format:Y-m-d',
        'repasse.valor_repasse' => 'nullable|numeric',
        'repasse.data_recebimento' => 'nullable|date_format:Y-m-d',
        'repasse.valor_recebimento' => 'nullable|numeric',
        'repasse.obs' => 'nullable|string',
    ];

    public function mount($id) {
        $this->repasse = new Transfer();
        $this->contrato_id = $id;
    }

    public function render()
    {
        $this->contratos = Contract::all();
        return view('livewire.repasses.cadastro', [
            'repasses' => $this->repasses
        ]);
    }

    public function getRepassesProperty()
    {
        return $this->repassesQuery->paginate(10);
    }

    public function getRepassesQueryProperty()
    {
        return Transfer::where('contract_id', $this->contrato_id)->orderBy('data_recebimento');
    }

    public function updated($field) {
        if ($field == 'repasse.valor_repasse')
        {
            $this->repasse->valor_repasse = str_replace(",",".",$this->repasse->valor_repasse);
        }
        if ($field == 'repasse.valor_recebimento')
        {
            $this->repasse->valor_recebimento = str_replace(",",".",$this->repasse->valor_recebimento);
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
        $this->repasse = new Transfer();
    }

    public function store()
    {
        $this->validate();
        $this->repasse->contract_id = $this->contrato_id;
        $this->repasse->save();

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $this->repasse = Transfer::findOrFail($id);

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Transfer::findOrFail($id)->delete();
        session()->flash('message', 'Repasse excluído!');
    }
}
