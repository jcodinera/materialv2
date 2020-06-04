<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    protected $table = "dbo.icmLibApprover";
    protected $primaryKey = "approver_id";

    public function MaterialType()
    {
        return $this->belongsTo(MaterialType::class, "mat_type_id");
    }

    public function account()
    {
        return $this->belongsTo(Accounts::class, "account_id");
    }

    public function headers()
    {
        return $this->hasMany(IcmHeader::class, "approverID");
    }
}
