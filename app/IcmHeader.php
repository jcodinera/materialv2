<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IcmHeader extends Model
{
    protected $fillable = [
        "materialTypeID",
        "shortDescription",
        "longDescription",
        "mfrNumber",
        "buyPrice",
        "refDoc",
        "statusID",
        "creatorID",
        "approverID",
        "dateRequested",
        "dateCreated",
        "dateModified"
    ];
    public $timestamps = false;
    protected $primaryKey = "creationHeaderID";

    public function MaterialType()
    {
        return $this->belongsTo(MaterialType::class, "materialTypeID");
    }

    public function approver()
    {
        return $this->belongsTo(Approver::class, "approverID");
    }

    public function material()
    {
        return $this->hasOne(Material::class, "creationHeaderID");
    }
}
