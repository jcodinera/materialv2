@extends('layouts.app')

@section("title", "Approvals")

@section("content")
    <!-- Default box -->
    <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title pt-2">Approvals</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects text-center">
                <thead>
                    <tr>
                        <th>Material Type</th>
                        <th>Material Group 1</th>
                        <th>Material Group 2</th>
                        <th>Material Group 3</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($approvals as $approval)
                        <tr>
                            <td>{{$approval->header->MaterialType->description}}</td>
                            <td>{{$approval->MatGroup1->Maj1}}</td>
                            <td>{{$approval->MatGroup2->Maj2}}</td>
                            <td>{{\App\MatGroup3::where("MatGrp3", $approval->matGrp3)->first()}}</td>
                            <td class="project-state">
                                @if($approval->remarks == "Approved")
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td class="project-actions">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#approval{{$approval->matHeaderID}}" type="button">
                                    <i class="fas fa-folder"></i>
                                    View
                                </button>
                                <a class="btn btn-warning btn-sm" href="#">
                                    <i class="fas fa-pencil-alt"></i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="approval{{$approval->matHeaderID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">View Approval</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <div id="accordion">
                                                    <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                                                    <div class="card card-info">
                                                        <div class="card-header">
                                                            <h4 class="card-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                                    Request Details
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseOne" class="panel-collapse collapse in">
                                                            <div class="card-body border border-info">
                                                                <dl class="dl-horizontal">
                                                                    <dt>Requestor:</dt>
                                                                    <dd>User's name</dd>
                                                                    <dt>Material Type:</dt>
                                                                    <dd>{{$approval->header->MaterialType->description}}</dd>
                                                                    <dt>Mfr Part Number:</dt>
                                                                    <dd>{{$approval->header->mfrNumber}}</dd>
                                                                    <dt>Buy Price:</dt>
                                                                    <dd>{{$approval->header->buyPrice}}</dd>
                                                                    <dt>Date Requested:</dt>
                                                                    <dd>{{$approval->header->buyPrice}}</dd>
                                                                    <dt>Long Description:</dt>
                                                                    <dd>{{$approval->header->longDescription}}</dd>
                                                                    <dt>Short Description:</dt>
                                                                    <dd>{{$approval->header->shortDescription}}</dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card card-dark">
                                                        <div class="card-header">
                                                            <h4 class="card-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                                    Approval Details
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseOne" class="panel-collapse collapse in">
                                                            <div class="card-body border border-dark">
                                                                <dl class="dl-horizontal">
                                                                    <dt>Approver:</dt>
                                                                    <dd>{{$approval->header->approver->account->AccountName}}</dd>
                                                                    <dt>Status:</dt>
                                                                    <dd>{{$approval->remarks}}</dd>
                                                                    <dt>Material Group 1:</dt>
                                                                    <dd>{{$approval->MatGroup1->Maj1}}</dd>
                                                                    <dt>Material Group 2:</dt>
                                                                    <dd>{{$approval->MatGroup2->Maj2}}</dd>
                                                                    <dt>Material Group 3:</dt>
                                                                    <dd>Nfdgfdgdfg</dd>
                                                                    <dt>Category Assignment:</dt>
                                                                    <dd>
                                                                        {{$approval->MatGroup1->MatGrp1.$approval->MatGroup2->MatGrp2."fgj"}}
                                                                        &nbsp;
                                                                        {{$approval->MatGroup1->Maj1." - ".$approval->MatGroup2->Maj2."."."gffhgdgdgff"}}
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@section("css")
    <link href="{{asset("plugins/select2/css/select2.min.css")}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/toastr/toastr.min.css")}}">
@endsection

@section("js")
    <script src="{{asset("plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("plugins/toastr/toastr.min.js")}}"></script>
@endsection
