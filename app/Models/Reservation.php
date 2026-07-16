<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['reservation_code', 'user_id', 'table_id', 'reservation_date', 'start_time', 'notes', 'end_time', 'guests_count', 'status'])]
class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
