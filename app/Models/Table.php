<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'table_number',
    'area',
    'capacity',
    'status',
    'image',
    'description',
    'is_active'
])]
class Table extends Model
{
    use HasFactory, SoftDeletes;

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
