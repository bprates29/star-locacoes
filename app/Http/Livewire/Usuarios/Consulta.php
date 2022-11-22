<?php
namespace App\Http\Livewire\Usuarios;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Consulta extends Component
{
    use WithPagination;
    public $searchUser;
    private $paginate = 10;

    public function render()
    {
        return view('livewire.usuarios.consulta', [
            'users' => $this->usersQuery->paginate($this->paginate)
        ]);
    }

    public function getUsersQueryProperty()
    {
        $searchUser = '%' . strtoupper($this->searchUser) . '%';
        return User::where(function ($query) use ($searchUser) {
                $query->where('name', 'like', $searchUser)
                    ->orWhere('email', 'like', $searchUser)
                    ->orWhere('cpf', 'like', $searchUser);
            })
            ->orderBy('name');
    }
}
