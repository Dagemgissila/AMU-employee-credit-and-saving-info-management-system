<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Share extends Model
{
    use HasFactory;

    protected $fillable=[
        'member_id',
        'share_amount'
    ];

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
