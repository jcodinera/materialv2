<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $table = "dbo.icmHeader";
    protected $fillable = [
        "materialTypeID",
        "shortDescription",
        "longDescription",
        "mfrNumber",
        "buyPrice",
        "refDoc"
    ];
    public $timestamps = false;
    protected $dates = [
        "dateRequested", "dateCreated", "dateModified"
    ];
}
