<?php

namespace App\Imports;

use App\Models\SavingAccount;
use Maatwebsite\Excel\Concerns\ToModel;

class SavingaccountsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SavingAccount([
            //
        ]);
    }
}
