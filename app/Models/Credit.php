<?php

namespace App\Models;

use App\Models\Member;
use App\Models\CreditPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function creditpayment(){
        return $this->hasMany(CreditPayment::class);
    }
}
