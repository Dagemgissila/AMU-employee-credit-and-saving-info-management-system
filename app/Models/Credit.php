<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable=[
        'member_id',
        'credit_amount',
        'interest_rate',
        'interest_amount',
        'total_payment',
        'credit_start',
        'credit_end',
        'witness1',
        'witness2',
        'witness3',
        'credit_status'
    ];

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
