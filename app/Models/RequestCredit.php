<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestCredit extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',

    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
