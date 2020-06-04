<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = "dbo.icmMaterial";
    protected $fillable = [
        "matHeaderID",
        "creationHeaderID",
        "matGrp1",
        "matGrp2",
        "matGrp3",
        "remarks"
    ];
    public $timestamps = false;

    public function header()
    {
        return $this->belongsTo(IcmHeader::class, "creationHeaderID");
    }

    public function MatGroup1()
    {
        return $this->belongsTo(MatGroup1::class, "matGrp1");
    }

    public function MatGroup2()
    {
        return $this->belongsTo(MatGroup2::class, "matGrp2")->where("MatGrp1", $this->MatGroup1->MatGrp1);
    }

    public function MatGroup3()
    {
        if (strlen((string)$this->matGrp3) == 1)
            $this->matGrp3 = (string)("00".$this->matGrp3);
        if (strlen((string)$this->matGrp3) == 2)
            $this->matGrp3 = (string)("0".$this->matGrp3);
        return $this->belongsTo(MatGroup3::class, "matGrp3")->where("MatGrp3", $this->matGrp3);
    }
}
