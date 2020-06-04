<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    protected $table = "dbo.icmLibMaterialType";
    protected $primaryKey = "matTypeID";

    public function IcmHeader()
    {
        return $this->hasOne(IcmHeader::class, "materialTypeID");
    }

    public function Approver()
    {
        return $this->hasMany(Approver::class, "mat_type_id");
    }
}
