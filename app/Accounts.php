<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $table = "dbo.cdbAccounts";
    protected $primaryKey = "AccountID";

    public function approver()
    {
        return $this->hasMany(Approver::class, "account_id");
    }
}
