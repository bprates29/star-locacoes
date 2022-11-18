<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_recebimento',
        'valor_recebimento',
        'data_repasse',
        'valor_repasse',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
