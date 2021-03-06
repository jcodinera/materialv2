@extends('layouts.app')

@section("title", "Create Approval")

@section('content')
    {{--Requestor Details--}}
    <div class="card">
        <div class="card-header bg-gradient-primary align-items-center">
            <h3 class="card-title">Requestor Details</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body border border-primary">
            <div class="row d-flex align-items-center">
                <div class="col-sm mx-1">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-5 px-0 py-1 text-bold">Requestor:</div>
                        {{--Change this to name of the User--}}
                        <div class="col-sm-7 py-1">Joven Codinera</div>
                    </div>
                </div>
                <div class="col-sm mx-1">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-5 px-0 py-1 text-bold">Material Type:</div>
                        <div class="col-sm-7 py-1">{{$header->MaterialType->description}}</div>
                    </div>
                </div>
                <div class="col-sm mx-1">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-6 px-0 py-1 text-bold">Approver Name:</div>
                        <div class="col-sm-6 py-1">{{$header->approver->account->AccountName}}</div>
                    </div>
                </div>
            </div>
            <div class="row d-flex align-items-center">
                <div class="col-sm mx-1">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-5 px-0 py-1 text-bold">Mfr Part Number:</div>
                        <div class="col-sm-7 py-1">{{$header->mfrNumber}}</div>
                    </div>
                </div>
                <div class="col-sm mx-1">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-5 px-0 py-1 text-bold">Buy Price:</div>
                        <div class="col-sm-7 py-1">{{$header->buyPrice}}</div>
                    </div>
                </div>
                <div class="col-sm mx-1">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-6 px-0 py-1 text-bold">Date Requested:</div>
                        <div class="col-sm-6 py-1">{{$header->dateRequested}}</div>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="text-bold ml-1">Long Description:</div>
                <div class="col-12">{{$header->longDescription}}</div>
            </div>
            <div class="row my-3">
                <div class="text-bold ml-1">Short Description:</div>
                <div class="col-12">{{$header->shortDescription}}</div>
            </div>
            <div class="accordion mt-3" id="accordionExample">
                <div class="card">
                    <div class="card-header pl-0" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link pl-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <strong class="text-dark">Reference Doc<small>(click to show)</small> </strong>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body border border-secondary">
                            {{$header->refDoc}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Approver's Form--}}
    <div class="card">
        <h4 class="card-header bg-gradient-gray-dark text-center">Approver Form</h4>
        <div class="card-body">
            <form action="{{route("approvals.store")}}" method="POST">
                @csrf
                {{--Product Manager & Approved--}}
                <div class="row d-flex align-items-center">
                    <div class="col-sm-7">
                        <div class="form-group row d-flex align-items-center">
                            <label for="productManager" class="col-sm-3 col-form-label">PRODUCT MANAGER :</label>
                            <div class="col-sm-9">
{{--                                <input type="text" class="form-control  @error("productManager") is-invalid @enderror" id="productManager" name="productManager">--}}
                                <input type="text" id="productManager" name="productManager" readonly class="text-bold" value="{{$header->approver->account->AccountName}}"
                                       style="border:none; outline: none; background-color: transparent; font-family: inherit; font-size: inherit; width: 100%">
                                @error("productManager")
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group row d-flex align-items-center ml-2">
                            <label for="approved" class="col-sm-3 col-form-label">Approved :</label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio d-inline mr-2">
                                    <input class="custom-control-input" type="radio" id="approvedYes" name="approved">
                                    <label for="approvedYes" class="custom-control-label">Yes</label>
                                </div>
                                <div class="custom-control custom-radio d-inline">
                                    <input class="custom-control-input" type="radio" id="approvedNo" name="approved">
                                    <label for="approvedNo" class="custom-control-label">No</label>
                                </div>
                                @error("approved")
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{--Material Groups--}}
                <div class="row d-flex align-items-center">
                    {{--Material Group 1--}}
                    <div class="col-sm mx-2">
                        <div class="form-group row d-flex align-items-center">
                            <label for="materialGroup1" class="col-sm-4 col-form-label">Mat. Group 1 :</label>
                            <div class="col-sm-8">
                                <select class="form-control select2 select2bs4 @error("categoryAssignment") is-invalid @enderror" style="width: 100%;"
                                        name="materialGroup1" id="materialGroup1">
                                    <option value="MG1CA0">Select Material Group</option>
                                    @foreach($matGroups1 as $matGroup1)
                                        <option id="MG1CA{{$matGroup1->MatGrp1}}" value="{{$matGroup1->MatGrp1}}">{{$matGroup1->Maj1}}</option>
                                    @endforeach
                                </select>
                                @error("materialGroup1")
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{--Material Group 2--}}
                    <div class="col-sm mx-2" id="MG2_col">
                        <div class="form-group row d-flex align-items-center">
                            <label for="materialGroup2" class="col-sm-4 col-form-label">Mat. Group 2 :</label>
                            <div class="col-sm-8">
                                <select class="form-control select2 select2bs4 @error("categoryAssignment") is-invalid @enderror" style="width: 100%;"
                                        name="materialGroup2" id="materialGroup2">
                                    <option value="MG2CA0">Select Material Group 1 first</option>
                                </select>
                                @error("materialGroup2")
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{--Material Group 3--}}
                    <div class="col-sm mx-2" id="MG3_col">
                        <div class="form-group row d-flex align-items-center">
                            <label for="materialGroup3" class="col-sm-4 col-form-label">Mat. Group 3 :</label>
                            <div class="col-sm-8">
                                <select class="form-control select2 select2bs4 @error("categoryAssignment") is-invalid @enderror" style="width: 100%;"
                                        name="materialGroup3" id="materialGroup3">
                                    <option value="MG3CA0">Select Material Group 1/2 first</option>
                                </select>
                                @error("materialGroup3")
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{--Category Assignment--}}
                <div class="form-group row d-flex align-items-center mt-2">
                    <label for="catAssignmentForm" class="col-sm-2 col-form-label">Category Assignment :</label>
                    <div class="col-sm-10">
                        <strong id="categoryAssignment" hidden>
                            <span id="all_MG_ID">
                            </span>
                            &nbsp;
                            <span id="all_MG_NAME">
                            </span>
                        </strong>
                        <input type="text" id="catAssignmentForm" name="categoryAssignment" readonly class="text-bold"
                               style="border:none; outline: none; background-color: transparent; font-family: inherit; font-size: inherit; width: 100%">
                        @error("categoryAssignment")
                            <p class="text-danger pb-2">{{$message}} Please select Material Groups.</p>
                        @enderror
                    </div>
                </div>

                {{--Hidden Values--}}
                <div class="form-group" hidden>
                    <label for="creationHeaderID"></label>
                    <input type="number" name="creationHeaderID" value="{{$header->creationHeaderID}}" id="creationHeaderID">
                </div>

                {{--Submit Button--}}
                <div class="text-center">
                    <button class="btn btn-info my-2" type="submit">Request for New Material Group</button>
                </div>
            </form>
        </div>
    </div>

    {{--MFC & ICS--}}
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center bg-gradient-gray">
                        <th></th>
                        <th>MFC</th>
                        <th>ICS</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td class="text-bold pt-3">PARTS</td>
                        <td class="form-group-sm">
                            <div class="row justify-content-center d-flex align-items-center">
                                <label for="partsMfcMonths" type="hidden"></label>
                                <input type="number" id="partsMfcMonths" name="partsMfcMonths" class="form-control" style="width: 60px">
                                <span class="text-danger ml-2">months</span>
                            </div>
                        </td>
                        <td class="form-group-sm">
                            <div class="row justify-content-center d-flex align-items-center">
                                <label for="partsIcsMonths" type="hidden"></label>
                                <input type="number" id="partsIcsMonths" name="partsIcsMonths" class="form-control" style="width: 60px">
                                <span class="text-danger ml-2">months</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold pt-3">LABOR</td>
                        <td class="form-group-sm">
                            <div class="row justify-content-center d-flex align-items-center">
                                <label for="laborMfcMonths" type="hidden"></label>
                                <input type="number" id="laborMfcMonths" name="laborMfcMonths" class="form-control" style="width: 60px">
                                <span class="text-danger ml-2">months</span>
                            </div>
                        </td>
                        <td class="form-group-sm">
                            <div class="row justify-content-center d-flex align-items-center">
                                <label for="laborIcsMonths" type="hidden"></label>
                                <input type="number" id="laborIcsMonths" name="laborIcsMonths" class="form-control" style="width: 60px">
                                <span class="text-danger ml-2">months</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold pt-3">ON-SITE</td>
                        <td class="form-group-sm">
                            <div class="row justify-content-center d-flex align-items-center">
                                <label for="onsiteMfcMonths" type="hidden"></label>
                                <input type="number" id="onsiteMfcMonths" name="onsiteMfcMonths" class="form-control" style="width: 60px">
                                <span class="text-danger ml-2">months</span>
                            </div>
                        </td>
                        <td class="form-group-sm">
                            <div class="row justify-content-center d-flex align-items-center">
                                <label for="onsiteIcsMonths" type="hidden"></label>
                                <input type="number" id="onsiteIcsMonths" name="onsiteIcsMonths" class="form-control" style="width: 60px">
                                <span class="text-danger ml-2">months</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card">
        <div class="card-body">
            {{--Waaranty, Vendor's Agreement, Local&Foreign--}}
            <div class="form-group row mt-4">
                {{--Warranty Period of Reference--}}
                <div class="col-sm-3 pl-5">
                    <label for="warranty">
                        Warranty Period of Reference <i class="fa fa-question-circle" id="tooltip"></i> :
                    </label>
                    <div class="d-block ml-3">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="warranty1" name="warranty">
                            <label for="warranty1" class="custom-control-label font-weight-normal">Delivery Date to Client</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="warranty2" name="warranty">
                            <label for="warranty2" class="custom-control-label font-weight-normal">Invoice Date of Supplier</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="warranty3" name="warranty">
                            <label for="warranty3" class="custom-control-label font-weight-normal">Receiving Date from Supplier</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="warrant4" name="warranty">
                            <label for="warrant4" class="custom-control-label font-weight-normal">Not Applicable</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-2">
                    {{--Vendor's Agreement--}}
                    <label for="vendorsAgreement">Vendor's Agreement :</label>
                    <select class="form-control select2 select2bs4 @error("vendorsAgreement") is-invalid @enderror" style="width: 100%"
                            name="vendorsAgreement" id="vendorsAgreement">
                        <option data-select2-id="0"></option>
                    </select>
                    @error("vendorsAgreement")
                    <p class="text-danger">{{$message}}</p>
                    @enderror

                    {{--Local&Foreign--}}
                    <div class="my-4">
                        <div class="custom-control custom-radio d-inline mr-2">
                            <input class="custom-control-input" type="radio" id="local" name="nationality">
                            <label for="local" class="custom-control-label">Local</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                            <input class="custom-control-input" type="radio" id="foreign" name="nationality">
                            <label for="foreign" class="custom-control-label">Foreign</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="row d-flex align-items-center">
                        {{-- $ Cost--}}
                        <div class="col-sm-5">
                            <div class="row d-flex align-items-center">
                                <label class="col-sm-4 col-form-label" for="cost">$ Cost:</label>
                                <div class="col-sm-8">
                                    <input type="number" id="cost" name="cost" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{--Acquired Cost--}}
                        <div class="col-sm-7">
                            <div class="row d-flex align-items-center">
                                <label class="col-sm-4 col-form-label" for="acquiredCost">Acquired Cost:</label>
                                <div class="col-sm-8">
                                    <input type="number" id="acquiredCost" name="acquiredCost" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center">
                        {{--List Price--}}
                        <div class="col-sm-5">
                            <div class="row d-flex align-items-center">
                                <label class="col-sm-4 col-form-label" for="listPrice">List Price:</label>
                                <div class="col-sm-8">
                                    <input type="number" id="listPrice" name="listPrice" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{--Dealer Price--}}
                        <div class="col-sm-7">
                            <div class="row d-flex align-items-center">
                                <label class="col-sm-4 col-form-label" for="dealerPrice">Dealer Price:</label>
                                <div class="col-sm-8">
                                    <input type="number" id="dealerPrice" name="dealerPrice" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--Notes/Remarks--}}
            <div class="form-group row my-3">
                <label class="col-sm-3 col-form-label text-center" for="remarks">Notes/Remarks :</label>
                <div class="col-sm-9">
                    <input type="text" id="remarks" name="remarks" class="form-control">
                </div>
            </div>
        </div>
    </div>
@endsection

@section("css")
    <link href="{{asset("plugins/select2/css/select2.min.css")}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/sweetalert2/sweetalert2.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")}}">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset("plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("plugins/sweetalert2/sweetalert2.min.js")}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    {{--    Tooltip--}}
    <script>
        $(document).ready(function(){
            $('#tooltip').tooltip({
                title:  "<span class=\"text-primary\">(NOT APPLICABLE option for <span class=\"text-success\">service</span> type of product only)</span>",
                html: true
            });
        });
    </script>
    {{--    Material Group Dynamic Dropdown--}}
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="materialGroup1"]').on({
                change: function () {
                    var materialGrp1Id = $(this).val();
                    if (materialGrp1Id && materialGrp1Id > 0) {
                        var content1 = document.getElementById('MG1CA' + materialGrp1Id).textContent;
                        $.ajax({
                            url: '/matGroups2/' + materialGrp1Id,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                $('select[name="materialGroup2"]').empty().append('<option value="'+ 0 +'">'+ 'Select Material Group 2' +'</option>');
                                $('select[name="materialGroup3"]').empty().append('<option value="'+ 0 +'">'+ 'Select Material Group 2 first' +'</option>');
                                $.each(data, function (Maj2, MatGrp2) {
                                    jQuery('select[name="materialGroup2"]').append('<option id="MG2CA' + MatGrp2 + '"' + ' value="'+ MatGrp2 +'">'+ Maj2 +'</option>');
                                });

                                // Do not chow Mat Grp 2 column if there is no data in DB
                                if (data.length < 1)
                                    $('#MG2_col').hide();
                                else
                                    $('#MG2_col').show();
                            }
                        });
                        // Material Group 1 CA
                        $("#MG1CA_ID").remove();
                        $("#MG2CA_ID").remove();
                        $("#MG3CA_ID").remove();
                        $('span[id="all_MG_ID"]').append('<span id="MG1CA_ID"></span>');
                        $('span[id="MG1CA_ID"]').append(materialGrp1Id);

                        $("#MG1CA_NAME").remove();
                        $("#MG2CA_NAME").remove();
                        $("#MG3CA_NAME").remove();
                        $('span[id="all_MG_NAME"]').append('<span id="MG1CA_NAME"></span>');
                        $('span[id="MG1CA_NAME"]').append(content1);
                        //
                        $('#catAssignmentForm').val($('#MG1CA_ID').text() + ' ' + $('#MG1CA_NAME').text());
                    } else {
                        $('#catAssignmentForm').val('');
                        $('select[name="materialGroup2"]').empty().append('<option value="'+ 0 +'">'+ 'Select Material Group 1 first' +'</option>');
                    };
                }
            });
            $('select[name="materialGroup2"]').on({
                change: function () {
                    var materialGrp2Id = $(this).val();
                    if (materialGrp2Id && materialGrp2Id > 0) {
                        var content2 = document.getElementById('MG2CA' + materialGrp2Id).textContent;
                        $.ajax({
                            url: '/matGroups3/' + materialGrp2Id,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                $('select[name="materialGroup3"]').empty().append('<option value="'+ 0 +'">'+ 'Select Material Group 3' +'</option>');
                                $.each(data, function (brand, MatGrp3) {
                                    // jQuery('select[name="materialGroup3"]').append('<option value="'+ MatGrp3 +'">'+ brand +'</option>');
                                    jQuery('select[name="materialGroup3"]').append('<option id="MG3CA' + MatGrp3 + '"' + ' value="'+ MatGrp3 +'">'+ brand +'</option>');
                                });

                                // Do not chow Mat Grp 23 column if there is no data in DB
                                if (data.length < 1)
                                    $('#MG3_col').hide();
                                else
                                    $('#MG3_col').show();
                            }
                        });
                        // Material Group 2 CA
                        $("#MG2CA_ID").remove();
                        $("#MG3CA_ID").remove();
                        $('span[id="all_MG_ID"]').append('<span id="MG2CA_ID"></span>');
                        $('span[id="MG2CA_ID"]').append(materialGrp2Id);

                        $("#MG2CA_NAME").remove();
                        $("#MG3CA_NAME").remove();
                        $('span[id="all_MG_NAME"]').append('<span id="MG2CA_NAME"></span>');
                        $('span[id="MG2CA_NAME"]').append(' - ' + content2);
                        //
                        $('#catAssignmentForm').val($('#MG1CA_ID').text() + $('#MG2CA_ID').text() + ' ' + $('#MG1CA_NAME').text() +
                            $('#MG2CA_NAME').text());
                    } else {
                        $('select[name="materialGroup3"]').empty().append('<option value="'+ 0 +'">'+ 'Select Material Group 2 first' +'</option>');
                    };
                }
            });
            $('select[name="materialGroup3"]').on({
                change: function () {
                    var materialGrp3Id = $(this).val();
                    var content3 = document.getElementById('MG3CA' + materialGrp3Id).textContent;
                    if (materialGrp3Id && materialGrp3Id > 0) {
                        // Material Group 3 CA
                        $("#MG3CA_ID").remove();
                        $('span[id="all_MG_ID"]').append('<span id="MG3CA_ID"></span>');
                        $('span[id="MG3CA_ID"]').append(materialGrp3Id);

                        $("#MG3CA_NAME").remove();
                        $('span[id="all_MG_NAME"]').append('<span id="MG3CA_NAME"></span>');
                        $('span[id="MG3CA_NAME"]').append('.' + content3);
                        //
                    };
                    $('#catAssignmentForm').val($('#MG1CA_ID').text() + $('#MG2CA_ID').text() + $('#MG3CA_ID').text() + ' ' + $('#MG1CA_NAME').text() +
                        $('#MG2CA_NAME').text() + $('#MG3CA_NAME').text());
                }
            });
        });
    </script>
    {{--    Select 2--}}
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
    {{--Sweet Alert 2--}}
    <script type="text/javascript">
        $(document).ready(function () {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            const createFlag = "{{session()->has("success")}}";
            if (createFlag) {
                Toast.fire({
                    type: 'success',
                    title: "{{session()->get("success")}}"
                });
            }
        });
    </script>
@stop
