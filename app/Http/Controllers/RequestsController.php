<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\Approver;
use App\Header;
use App\Http\Requests\CreateRequests;
use App\MaterialType;
use Carbon\Carbon;

class RequestsController extends Controller
{
    public function create()
    {
        $materialTypes = MaterialType::all()->sortBy("description");
        $approvers = Approver::all()->pluck("account_id")->unique();
        $accounts = Accounts::whereIn("AccountID", $approvers)->get()->sortBy("AccountName");

        return view("requests/create")->with([
            "materialTypes"=>$materialTypes,
            "accounts"=>$accounts
        ]);
    }

    public function approvers($materialTypeId)
    {
        $approvers = Approver::where("mat_type_id", $materialTypeId)->pluck("account_id")->unique();
        $accounts = Accounts::whereIn("AccountID", $approvers)->get()->sortBy("AccountName")->pluck("AccountName","AccountID");
        return json_encode($accounts->toArray());
    }

    public function store(CreateRequests $request)
    {
//        Header::create([
//            "materialTypeID"=>$request->materialType,
//            "shortDescription"=>$request->shortDescription,
//            "longDescription"=>$request->longDescription,
//            "mfrNumber"=>$request->mfrPartNo,
//            "buyPrice"=>$request->buyPrice,
//            "refDoc"=>$request->referenceDoc,
//            "statusID"=>"1",
//            "creatorID"=>"56395",
//            "dateRequested"=>Carbon::now()->toDateTime(),
//            "dateCreated"=>Carbon::now(),
//            "dateModified"=>Carbon::now()->toDateString(),
//        ]);

//        $header = new Header();
//        $header->materialTypeID = $request->materialType;
//        $header->shortDescription = $request->shortDescription;
//        $header->longDescription = $request->longDescription;
//        $header->mfrNumber = $request->mfrPartNo;
//        $header->buyPrice = $request->buyPrice;
//        $header->refDoc = $request->referenceDoc;
//        $header->statusID = 1;
//        $header->creatorID = 56395;
//        $header->dateRequested = Carbon::now();
//        $header->dateCreated = Carbon::now();
//        $header->dateModified = Carbon::now();
//
//        $header->save($header);

        return redirect(route("approvals.create"))->withCookie(cookie()->forever("success", "Request has been successfully created!"));
    }
}
