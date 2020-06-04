<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApprovals;
use App\IcmHeader;
use App\Material;
use App\MatGroup1;
use App\MatGroup2;
use App\MatGroup3;

class ApprovalsController extends Controller
{
    public function create($headerId)
    {
        $header = IcmHeader::where("creationHeaderID", $headerId)->first();

        return view("approvals/create")->with([
            "header"=>$header,
            "matGroups1"=>MatGroup1::all()->sortBy("Maj1")
        ]);
    }

    public function matGroups2($matGroup1Id)
    {
        $materialGroups2 = MatGroup2::where("MatGrp1", $matGroup1Id)->get()->sortBy("Maj2")->pluck("MatGrp2", "Maj2")->unique();
        return json_encode($materialGroups2->toArray());
    }

    public function matGroups3($matGroup2Id)
    {
        $materialGroups3 = MatGroup3::where("MatGrp2", $matGroup2Id)->get()->sortBy("Brand")->pluck("MatGrp3", "Brand")->unique();
        return json_encode($materialGroups3->toArray());
    }

    public function store(CreateApprovals $request)
    {
//        Remarks is missing
        Material::create([
            "creationHeaderID"=>$request->creationHeaderID,
            "matGrp1"=>$request->materialGroup1,
            "matGrp2"=>$request->materialGroup2,
            "matGrp3"=>$request->materialGroup3,
            "remarks"=>$request->approved == "on" ? "Approved" : "Rejected"
        ]);

        session()->flash("success", "Material has been Created successfully!");

        return redirect(route("approvals.index"));
    }

    public function index()
    {
//        dd(Material::first()->MatGroup3);
        dd(Material::select("matGrp3")->get());
        return view("approvals/index")->with(["approvals"=>Material::all()]);
    }
}
