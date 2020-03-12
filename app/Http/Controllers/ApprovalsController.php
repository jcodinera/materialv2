<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\Approver;
use App\Header;
use App\Http\Requests\CreateApprovals;
use App\Http\Requests\CreateRequests;
use App\Material;
use App\MaterialType;
use App\MatGroup1;
use App\MatGroup2;
use App\MatGroup3;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApprovalsController extends Controller
{
    public function create()
    {
        // Change depending on user login
        $creatorID = 56395;
        $header = Header::where("creatorID", $creatorID)->first();
        $materialType = MaterialType::where("matTypeID", $header->materialTypeID)->first()->description;

        return view("approvals/create")->with([
            "materialType"=>$materialType,
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
        $matHeaderID = Material::all()->count() > 0 ? (Material::orderBy("matHeaderID", "DESC")->first()->matHeaderID + 1) : 1;
//        Remarks is missing
        Material::create([
            "matHeaderID"=>$matHeaderID,
            "creationHeaderID"=>Header::orderBy("dateRequested", "DESC")->first()->creationHeaderID,
            "matGrp1"=>$request->materialGroup1,
            "matGrp2"=>$request->materialGroup2,
            "matGrp3"=>$request->materialGroup3,
            "remarks"=>null
        ]);

        session()->flash("success", "Material has been Created successfully!");

        return redirect(route("approvals.index"));
    }

    public function index()
    {

    }
}
