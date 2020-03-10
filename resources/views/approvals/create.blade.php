@extends('layouts.app')

@section("title", "Create Request")

@section('content')
    <div class="container offset-sm-1 col-sm-10 offset-sm-1">
        @if(session()->has("success"))
            <div class="alert alert-default-success text-center align-items-center">
                <p class="m-0">{{session()->get("success")}}</p>
            </div>
        @endif
{{--        Requestor Details--}}
        <div class="card">
            <div class="card-header bg-primary align-items-center">
                <h3 class="card-title">Requestor Details</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body border-primary" style="border-color: dodgerblue">
                <div class="row">
                    <div class="col-sm">
                        <div class="row">
                            <div class="col-4 text-bold">Requestor:</div>
                            <div class="col-8">ghjghjhgjgh</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <div class="col-4 text-bold">Material Type:</div>
                            <div class="col-8">ghjghjhgjgh</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <div class="col-5 text-bold">Approver Name:</div>
                            <div class="col-7">Joven Codinera</div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row my-3 mx-2">
                    <div class="col-12 mb-2 text-bold">Long Description:</div>
                    <div class="col-12 ml-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                </div>
                <div class="row my-3 mx-2">
                    <div class="col-12 mb-2 text-bold">Short Description:</div>
                    <div class="col-12 ml-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm">
                        <div class="row">
                            <div class="col-4 text-bold">Mfr Part No:</div>
                            <div class="col-8">partno</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <div class="col-4 text-bold">Buy Price:</div>
                            <div class="col-8">256.365236</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <div class="col-5 text-bold">Date Requested:</div>
                            <div class="col-7">03/06/2020 06:03:02 AM</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{--        Approver's Form--}}
        <div class="card" style="background-color: antiquewhite">
            <div class="card-body">
                <form action="{{route("approvals.store")}}" method="POST">
                    @csrf
                    {{--Product Manager & Approved--}}
                    <div class="form-group row">
                        <div class="col-7">
                            <div class="row">
                                <label for="productManager" class="col-sm-4 col-form-label">PRODUCT MANAGER :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control  @error("productManager") is-invalid @enderror" id="productManager" name="productManager">
                                    @error("productManager")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="row d-flex align-items-center ml-2">
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
                    <div class="form-group row">
                        {{--Material Group 1--}}
                        <div class="col">
                            <div class="row">
                                <label for="materialGroup1" class="col-sm-4 col-form-label">Mat. Group 1 :</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2 select2-hidden-accessible @error("materialGroup1") is-invalid @enderror"
                                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="materialGroup1" id="materialGroup1">
                                        <option value="{{0}}">Select Material Group</option>
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
                        <div class="col" id="MG2_col">
                            <div class="row">
                                <label for="materialGroup2" class="col-sm-4 col-form-label">Mat. Group 2 :</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2 select2-hidden-accessible @error("materialGroup2") is-invalid @enderror"
                                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="materialGroup2" id="materialGroup2">
                                    </select>
                                    @error("materialGroup2")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{--Material Group 3--}}
                        <div class="col" id="MG3_col">
                            <div class="row">
                                <label for="materialGroup3" class="col-sm-4 col-form-label">Mat. Group 3 :</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2 select2-hidden-accessible @error("materialGroup3") is-invalid @enderror"
                                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="materialGroup3" id="materialGroup3">
                                    </select>
                                    @error("materialGroup3")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Category Assignment--}}
                    <div class="form-group row d-flex align-items-center mt-4">
                        <label for="categoryAssignment" class="col-sm-2 col-form-label">Category Assignment :</label>
                        <div class="col-sm-10">
{{--                            <strong>100308432 BUSS APPLICATION-SERVICE.IVEND</strong>--}}
                            <strong id="categoryAssignment">
                                <span id="all_MG_ID">
{{--                                    <span id="MG1CA_ID">100</span><span id="MG2CA_ID">308</span><span id="MG3CA_ID">432</span>--}}
                                </span>
                                &nbsp;
                                <span id="all_MG_NAME">
{{--                                    <span id="MG1CA_NAME">BUSS APPLICATION</span><span id="MG2CA_NAME">-SERVICE.</span><span id="MG3CA_NAME">IVEND</span>--}}
                                </span>
                            </strong>
                        </div>
                    </div>

                    {{--Submit Button--}}
                    <div class="text-center">
                        <button class="btn btn-info my-2" type="submit" style="width: 30%">Request for New Material Group</button>
                    </div>
                </form>
            </div>
        </div>

{{--        MFC & ICS--}}
        <div class="row mb-1">
            <div class="offset-4 col-4">
                <span class="text-bold ml-4">MFC</span>
            </div>
            <div class="col-4">
                <span class="text-bold ml-4">ICS</span>
            </div>
        </div>
        <hr>
        <div class="row align-items-center my-2">
            <div class="col-4 text-bold">PARTS</div>
            <div class="col-4 d-flex align-items-center">
                <input type="number" id="partsMfcMonths" name="partsMfcMonths" class="form-control" style="width: 60px">
                <span class="text-danger ml-2">months</span>
            </div>
            <div class="col-4 d-flex align-items-center ">
                <input type="number" id="partsIcsMonths" name="partsIcsMonths" class="form-control" style="width: 60px">
                <span class="text-danger ml-2">months</span>
            </div>
        </div>
        <div class="row align-items-center  my-2">
            <div class="col-4 text-bold">LABOR</div>
            <div class="col-4 d-flex align-items-center">
                <input type="number" id="laborMfcMonths" name="laborMfcMonths" class="form-control" style="width: 60px">
                <span class="text-danger ml-2">months</span>
            </div>
            <div class="col-4 d-flex align-items-center ">
                <input type="number" id="laborIcsMonths" name="laborIcsMonths" class="form-control" style="width: 60px">
                <span class="text-danger ml-2">months</span>
            </div>
        </div>
        <div class="row align-items-center  my-2">
            <div class="col-4 text-bold">ON-SITE</div>
            <div class="col-4 d-flex align-items-center">
                <input type="number" id="onsiteMfcMonths" name="onsiteMfcMonths" class="form-control" style="width: 60px">
                <span class="text-danger ml-2">months</span>
            </div>
            <div class="col-4 d-flex align-items-center ">
                <input type="number" id="onsiteIcsMonths" name="onsiteIcsMonths" class="form-control" style="width: 60px">
                <span class="text-danger ml-2">months</span>
            </div>
        </div>

{{--        Waaranty, Vendor's Agreement, Local&Foreign--}}
        <div class="row mt-4">
            {{--Warranty Period of Reference--}}
            <div class="col-3 mt-2">
                <label for="warranty">
                    Warranty Period of Reference
                    <i class="fa fa-question-circle" id="tooltip"></i>
                    :
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


            <div class="col-9">
                {{--Vendor's Agreement--}}
                <label for="vendorsAgreement" class="col-sm-5 col-form-label">Vendor's Agreement :</label>
                <select class="form-control select2 select2-hidden-accessible @error("vendorsAgreement") is-invalid @enderror"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="vendorsAgreement" id="vendorsAgreement">
                    <option data-select2-id="0"></option>
                    {{--                        @foreach($icmMatGroup2s as $icmMatGroup2)--}}
                    <option data-select2-id="3">Alabama</option>
                    {{--                        @endforeach--}}
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
        </div>

        {{--Notes/Remarks--}}
        <div class="row my-3 text-center">
            <label class="col-sm-2 col-form-label" for="remarks">Notes/Remarks :</label>
            <div class="col-sm-10">
                <input type="text" id="remarks" name="remarks" class="form-control">
            </div>
        </div>

{{--        All Costs & Prices--}}
        <div class="row my-3 mt-4">
            {{--$ Cost--}}
            <div class="col">
                <div class="row">
                    <label class="col-sm-3 col-form-label" for="cost">$ Cost:</label>
                    <div class="col-sm-9">
                        <input type="text" id="cost" name="cost" class="form-control">
                    </div>
                </div>
            </div>
            {{--Acquired Cost--}}
            <div class="col">
                <div class="row">
                    <label class="col-sm-6 col-form-label" for="acquiredCost">Acquired Cost:</label>
                    <div class="col-sm-6">
                        <input type="text" id="acquiredCost" name="acquiredCost" class="form-control">
                    </div>
                </div>
            </div>
            {{--List Price--}}
            <div class="col">
                <div class="row">
                    <label class="col-sm-4 col-form-label" for="listPrice">List Price:</label>
                    <div class="col-sm-8">
                        <input type="text" id="listPrice" name="listPrice" class="form-control">
                    </div>
                </div>
            </div>
            {{--Dealer Price--}}
            <div class="col">
                <div class="row">
                    <label class="col-sm-5 col-form-label" for="dealerPrice">Dealer Price:</label>
                    <div class="col-sm-7 mb-4">
                        <input type="text" id="dealerPrice" name="dealerPrice" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
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
                    var content1 = document.getElementById('MG1CA' + materialGrp1Id).textContent;
                    if (materialGrp1Id && materialGrp1Id > 0) {
                        $.ajax({
                            url: '/matGroups2/' + materialGrp1Id,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                $('select[name="materialGroup3"]').empty();
                                $('select[name="materialGroup2"]').empty().append('<option value="'+ 0 +'">'+ 'Select Material Group 2' +'</option>');
                                $.each(data, function (Maj2, MatGrp2) {
                                    jQuery('select[name="materialGroup2"]').append('<option id="MG2CA' + MatGrp2 + '"' + ' value="'+ MatGrp2 +'">'+ Maj2 +'</option>');
                                });

                                // Do not chow Mat Grp 2 column if theres no data in DB
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
                    } else {
                        $('select[name="materialGroup2"]').empty().append('<option value="'+ 0 +'">'+ 'Select Material Group 1 first' +'</option>');
                    };
                }
            });
            $('select[name="materialGroup2"]').on({
                change: function () {
                    var materialGrp2Id = $(this).val();
                    var content2 = document.getElementById('MG2CA' + materialGrp2Id).textContent;
                    if (materialGrp2Id && materialGrp2Id > 0) {
                        $.ajax({
                            url: '/matGroups3/' + materialGrp2Id,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                console.log(data);
                                $('select[name="materialGroup3"]').empty().append('<option value="'+ 0 +'">'+ 'Select Material Group 3' +'</option>');
                                $.each(data, function (brand, MatGrp3) {
                                    // jQuery('select[name="materialGroup3"]').append('<option value="'+ MatGrp3 +'">'+ brand +'</option>');
                                    jQuery('select[name="materialGroup3"]').append('<option id="MG3CA' + MatGrp3 + '"' + ' value="'+ MatGrp3 +'">'+ brand +'</option>');
                                });

                                // Do not chow Mat Grp 23 column if theres no data in DB
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
                        $('span[id="MG2CA_NAME"]').append('-' + content2);
                        //
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
                    }
                }
            });
        });
    </script>
@stop
