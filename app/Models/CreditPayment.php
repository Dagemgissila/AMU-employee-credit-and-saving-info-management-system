<?php

namespace App\Models;

use App\Models\Credit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreditPayment extends Model
{
    use HasFactory;

    public function credits(){
        return $this->belongsTo(Credit::class);
    }
}
