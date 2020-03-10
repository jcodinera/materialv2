@extends('layouts.app')

@section("title", "Create Request")

@section('content')
    <div class="container offset-sm-1 col-sm-10 offset-sm-1 card card-body" style="background-color: lightgrey">
        <form action="{{route("requests.store")}}" method="POST">
            @csrf
            <div class="row text-center">
                <div class="col">
                    {{-- Requestor --}}
                    <div class="form-group row">
                        <label for="requestor" class="col-sm-3 col-form-label">REQUESTOR :</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error("requestor") is-invalid @enderror" id="requestor" name="requestor">
                            @error("requestor")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col">
                    {{-- Material Type --}}
                    <div class="row">
                        <label for="materialType" class="col-sm-3 col-form-label">Material Type :</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 select2-hidden-accessible @error("materialType") is-invalid @enderror"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="materialType" id="materialType">
                                <option selected data-select2-id="0">Select Material Type</option>
                                @foreach($materialTypes as $materialType)
                                    <option value="{{$materialType->matTypeID}}">{{$materialType->description}}</option>
                                @endforeach
                            </select>
                            @error("materialType")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Long Description --}}
            <div class="form-group row mt-4 ml-2">
                <label for="longDescription">
                    Long Description: (Naming Conventions :
                    <span class="text-primary" id="HDtooltipLD">HW</span>,
                    <span class="text-success" id="SWPtooltipLD">SWP</span>,
                    <span class="text-info" id="CSDtooltipLD">CSD</span>,
                    <span class="text-danger" id="CSCtooltipLD">CSC</span>
                    )
                </label>
                <textarea class="form-control mr-3 @error("longDescription") is-invalid @enderror" id="longDescription" name="longDescription"></textarea>
                @error("longDescription")
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            {{-- Short Description --}}
            <div class="form-group row mt-4 ml-2">
                <label for="shortDescription">
                    Short Description: (Naming Conventions :
                    <span class="text-primary" id="HDtooltipSD">HW</span>,
                    <span class="text-success" id="SWPtooltipSD">SWP</span>,
                    <span class="text-info" id="CSDtooltipSD">CSD</span>,
                    <span class="text-danger" id="CSCtooltipSD">CSC</span>
                    )
                </label>
                <textarea class="form-control mr-3 @error("shortDescription") is-invalid @enderror" id="shortDescription" name="shortDescription"></textarea>
                @error("shortDescription")
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group row">
                <div class="col">
                    {{-- Mfr Part Number. --}}
                    <div class="row mt-3 ml-1">
                        <label for="mfrPartNo" class="col-sm-4 col-form-label">Mfr Part Number:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error("mfrPartNo") is-invalid @enderror" id="mfrPartNo" name="mfrPartNo">
                            @error("mfrPartNo")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col">
                    {{-- Buy Price --}}
                    <div class="row mt-3">
                        <label for="buyPrice" class="col-sm-4 col-form-label">Buy Price :</label>
                        <div class="col-sm-8">
                            <input type="number" step=".000001" class="form-control @error("buyPrice") is-invalid @enderror" id="buyPrice" name="buyPrice">
                            @error("buyPrice")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    {{-- Date Requested --}}
                    <div class="form-group row ml-1">
                        <label for="buyPrice" class="col-sm-4 col-form-label">Date Requested :</label>
                        <div class="col-sm-8">
                            <p class="text-danger pt-2 text-left">{{date('Y/m/d H:m:s A')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    {{-- Approver Name --}}
                    <div class="form-group row">
                        <label for="approverName" class="col-sm-4 col-form-label align-items-center d-flex">Approver Name :</label>
                        <div class="col-sm-8">
{{--                            Tooltip--}}
{{--                            <p class="text-primary">(For SWP or Other HW item, please select appropriate name of <strong>product manager</strong>)</p>--}}
                            <select class="form-control select2 select2-hidden-accessible @error("approverName") is-invalid @enderror"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="approverName">
                                <option selected data-select2-id="0">Select Material Type first</option>
{{--                                @foreach($accounts as $account)--}}
{{--                                    <option value="{{$account->AccountName}}">{{$account->AccountName}}</option>--}}
{{--                                @endforeach--}}
                            </select>
                            @error("approverName")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reference Doc --}}
            <div class="form-group row ml-1">
                <label for="referenceDoc" class="col-12">Reference Doc :</label>
                <div class="ml-3">
                    <textarea name="referenceDoc" id="summernote" class="w-100"></textarea>
                    @error("referenceDoc")
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            {{-- Submit Button --}}
            <div>
                <button class="btn btn-primary my-4 w-100" type="submit">Submit for Approval</button>
            </div>
        </form>
    </div>
@endsection

@section("css")
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
{{--    Summernote--}}
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 100,
                width: "100%"
            });
        });
    </script>
{{--    Tooltip--}}
    <script>
        $(document).ready(function(){
            $('#HDtooltipLD').tooltip({
                title:  "<p>(Primary Component) <span class='text-primary'>brand/model/CPU/HDD/memory/opt drive/OS</span></p>" +
                        "<p>(Secondary Component) <span class='text-primary'>wlan/security/camera/screen type & size/software/input devices</span></p>",
                html: true
            });
            $('#SWPtooltipLD').tooltip({
                title:  "<p class='text-success'>brand/model/general description</p>",
                html: true
            });
            $('#CSDtooltipLD').tooltip({
                title:  "<p class='text-info'>brand/model/general description</p>",
                html: true
            });
            $('#CSCtooltipLD').tooltip({
                title:  "<p class='text-danger'>brand/PN [or] model#/capacity/where used</p>",
                html: true
            });
            $('#HDtooltipSD').tooltip({
                title:  "<p class='text-primary'>brand/model/CPU/HDD/memory/opt drive/OS</p>",
                html: true
            });
            $('#SWPtooltipSD').tooltip({
                title:  "<p class='text-success'>brand/model/general description</p>",
                html: true
            });
            $('#CSDtooltipSD').tooltip({
                title:  "<p class='text-info'>brand/model/general description</p>",
                html: true
            });
            $('#CSCtooltipSD').tooltip({
                title:  "<p class='text-danger'>brand/PN [or] model#/capacity/where used</p>",
                html: true
            });
        });
    </script>
{{--    Approvers Dynamic Dropdown--}}
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="materialType"]').on('change', function () {
                var materialTypeId = $(this).val();
                if (materialTypeId && materialTypeId > 0) {
                    $.ajax({
                        url:'/materialTypes/' + materialTypeId,
                        type: 'GET',
                        dataType: "json",
                        success: function (data) {
                            $('select[name="approverName"]').empty();
                            $.each(data, function (key, value) {
                                jQuery('select[name="approverName"]').append('<option value="'+ value +'">'+ value +'</option>');
                            })
                        }
                    });
                } else {
                    $('select[name="approverName"]').empty().append('<option value="'+ 0 +'">'+ 'Select Material Type first' +'</option>');
                }
            })
        })
    </script>
@stop
