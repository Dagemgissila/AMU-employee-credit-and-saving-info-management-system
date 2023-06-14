<?php

namespace App\Models;

use App\Models\User;
use App\Models\Credit;
use App\Models\SavingAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'salary',
        'user_id',
        'campus',
        'sex',
        'colleage',
        'martial_status',
        'phone_number',
        'registered_date',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function savingAccounts()
    {
        return $this->hasMany(SavingAccount::class);
    }

    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

}