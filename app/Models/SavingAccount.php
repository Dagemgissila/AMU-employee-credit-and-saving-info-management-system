<?php

namespace App\Models;

use App\Models\User;
use App\Models\SavingDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavingAccount extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'saving_amount', 'saving_month', 'saving_percent'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }


}
