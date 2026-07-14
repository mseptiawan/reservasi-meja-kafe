<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['reservation_id', 'payment_code', 'amount', 'proof_of_payment', 'status', 'admin_note'])]
class Payment extends Model
{
    use HasFactory;

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
