@extends('layouts.app')

@section("title", "Requests")

@section("content")
    <!-- Default box -->
    <div class="card">
        <div class="card-header bg-gradient-info">
            <h3 class="card-title pt-2">Requests</h3>
            <a href="{{route("requests.create")}}" class="btn btn-dark btn-sm float-right">New Request</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects text-center">
                <thead>
                    <tr>
                        <th>Mfr Number</th>
                        <th>Date Requested</th>
                        <th>Material Type</th>
                        <th>Buy Price</th>
                        <th>Approver</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                        <tr>
                            <td><a>{{$request->mfrNumber}}</a></td>
                            <td>{{$request->dateRequested}}</td>
                            <td>{{$request->MaterialType->description}}</td>
                            <td>{{$request->buyPrice}}</td>
                            <td>{{$request->MaterialType->Approver[0]->account->AccountName}}</td>
                            <td class="project-actions">
                                <a class="btn btn-primary btn-sm" href="{{route("approvals.create", $request->creationHeaderID)}}">
                                    <i class="fas fa-folder"></i>
                                    View
                                </a>
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
