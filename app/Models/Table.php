<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['table_number', 'capacity', 'status'])]
class Table extends Model
{
    use HasFactory;

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
