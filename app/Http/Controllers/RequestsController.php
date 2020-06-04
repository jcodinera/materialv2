<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\Approver;
use App\Header;
use App\HeaderApprover;
use App\Http\Requests\CreateRequests;
use App\IcmHeader;
use App\MaterialType;
use Illuminate\Http\Request;
use PDO;

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

    public function store(CreateRequests $requests)
    {
        $creatorID = rand(114, 57636);
        IcmHeader::create([
            "materialTypeID"=>$requests->materialType,
            "shortDescription"=>$requests->shortDescription,
            "longDescription"=>$requests->longDescription,
            "mfrNumber"=>$requests->mfrPartNo,
            "buyPrice"=>$requests->buyPrice,
            "refDoc"=>$requests->referenceDoc,
            "statusID"=>1,
            "creatorID"=>$creatorID,
            "approverID"=>Approver::where("mat_type_id", $requests->materialType)->where("account_id", $requests->approverId)->first()->approver_id,
            "dateRequested"=>$requests->dateRequested,
            "dateCreated"=>$requests->dateRequested,
            "dateModified"=>$requests->dateRequested
        ]);

        return redirect(route("requests.index"));
    }

    public function store2(Request $request)
    {
        $serverName = env("DB_HOST");
        $database = env("DB_DATABASE");
        $table = (new Header())->getTable();

        $requestData = $request->all();
        $todayDate = date("Y-m-d H:i:s");

        $data = [
            "materialTypeID"=>$requestData["materialType"],
            'shortDescription'=>$requestData["shortDescription"],
            'longDescription'=>$requestData["longDescription"],
            'mfrNumber'=>$requestData["mfrPartNo"],
            'buyPrice'=>$requestData["buyPrice"],
            'refDoc'=>$requestData["referenceDoc"],
            'statusID'=>null,
            'creatorID'=>null,
            'dateRequested'=>$todayDate,
            'dateCreated'=>$todayDate,
            'dateModified'=>$todayDate
        ];

        try {
            $pdo = new \PDO("sqlsrv:server=$serverName;Database=".$database, env("DB_USERNAME"), env("DB_PASSWORD"));

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare("
                INSERT INTO $table(materialTypeID, shortDescription, longDescription, mfrNumber, buyPrice, refDoc, statusID, creatorID, dateRequested, dateCreated, dateModified)
                VALUES (:materialTypeID, :shortDescription, :longDescription, :mfrNumber, :buyPrice, :refDoc, :statusID, :creatorID, :dateRequested, :dateCreated, :dateModified)
            ");

            $sql->execute($data);
        } catch (\PDOException $exception) {
            echo "Connection failed: ".$exception->getMessage();
        }

        return redirect(route("approvals.create"))->with([
            "success"=>"Request has been successfully created",
            "approverName"=>Accounts::where("AccountID", $request->approverName)->first()->AccountName
        ]);
    }

    public function index()
    {
        return view("requests/index")->with("requests", IcmHeader::all()->sortByDesc("dateRequested"));
    }
}
