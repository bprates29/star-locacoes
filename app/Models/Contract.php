<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_inicio',
        'data_fim',
        'valor_diario',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($contract) { // before delete() method call this
            $contract->transfer()->delete();
            // do the rest of the cleanup...
        });
    }

}
