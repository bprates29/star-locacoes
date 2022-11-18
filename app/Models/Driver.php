<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'cnh',
        'telefone',
        'obs'
    ];

    public function contract()
    {
        return $this->hasMany(Contract::class);
    }
}
