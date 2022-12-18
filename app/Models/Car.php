<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'placa',
        'renavan',
        'marca',
        'data_inicio',
        'obs'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contract()
    {
        return $this->hasMany(Contract::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function driver()
    {
        return $this->belongsToMany(Driver::class, 'contracts', 'car_id', 'driver_id');
    }

    public function transfers() {
        return $this->belongsToMany(Transfer::class)->using(Contract::class);
    }



}
