@extends('layouts.app')

@section("title", "Create Request")

@section('content')
    <div class="card">
        <h4 class="text-center card-header bg-gradient-gray-dark">~ Requestor Form ~</h4>
        <div class="card-body">
            <form action="{{route("requests.store")}}" method="POST">
                @csrf
                <div class="row d-flex align-items-center">
                    <div class="col-sm mx-3">
                        {{-- Requestor --}}
                        <div class="form-group row d-flex align-items-center p-0">
                            <label for="requestor" class="col-sm-4 col-form-label">REQUESTOR :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error("requestor") is-invalid @enderror" id="requestor" name="requestor" disabled>
                                @error("requestor")
                                    <small class="text-danger text-left">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm mx-3">
                        {{-- Mfr Part Number. --}}
                        <div class="form-group row d-flex align-items-center p-0">
                            <label for="mfrPartNo" class="col-sm-4 col-form-label">Mfr Part Number:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error("mfrPartNo") is-invalid @enderror" id="mfrPartNo" name="mfrPartNo">
                                @error("mfrPartNo")
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm mx-3">
                        {{-- Date Requested --}}
                        <div class="form-group row d-flex align-items-center">
                            <label for="dateRequested" class="col-sm-5 col-form-label">Date Requested :</label>
                            <div class="col-sm-7 pt-1">
                                <input type="text" id="dateRequested" name="dateRequested" readonly class="text-bold text-danger" value="{{date('Y/m/d H:i:s A')}}"
                                       style="border:none; outline: none; background-color: transparent; font-family: inherit; font-size: inherit; width: 100%">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Long Description --}}
                <div class="form-group row mt-3 ml-2">
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
                        <small class="text-danger">{{$message}}</small>
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
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group row d-flex align-items-center">
                    <div class="col-sm mx-3">
                        {{-- Buy Price --}}
                        <div class="row d-flex align-items-center">
                            <label for="buyPrice" class="col-sm-4 col-form-label">Buy Price :</label>
                            <div class="col-sm-8">
                                <input type="number" step=".000001" class="form-control @error("buyPrice") is-invalid @enderror" id="buyPrice" name="buyPrice">
                                @error("buyPrice")
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm mx-3">
                        {{--Material Type--}}
                        <div class="row d-flex align-items-center">
                            <label for="materialType" class="col-sm-4 col-form-label">Material Type :</label>
                            <div class="col-sm-8">
                                <select class="form-control select2 select2bs4" style="width: 100%" name="materialType" id="materialType">
                                    <option value="0">Select Material Type</option>
                                    @foreach($materialTypes as $materialType)
                                        <option value="{{$materialType->matTypeID}}">{{$materialType->description}}</option>
                                    @endforeach
                                </select>
                                @error("materialType")
                                <small class="text-danger text-left">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm mx-3">
                        {{-- Approver Name --}}
                        <div class="row d-flex align-items-center">
                            <label for="approverName" class="col-sm-4 col-form-label align-items-center d-flex">Approver Name :</label>
                            <div class="col-sm-8">
                                {{--Tooltip--}}
                                <select class="form-control select2 select2bs4 @error("approverName") is-invalid @enderror"
                                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="approverName">
                                </select>
                                @error("approverName")
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Reference Doc --}}
                <div class="form-group row ml-1 justify-content-center">
                    <label for="referenceDoc" class="col-12">Reference Doc :</label>
                    <div class="ml-3">
                        <textarea name="referenceDoc" id="summernote" class="w-100"></textarea>
                        @error("referenceDoc")
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                {{-- Submit Button --}}
                <div>
                    <button class="btn btn-primary my-4 w-100" type="submit">Submit for Approval</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("css")
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="{{asset("plugins/select2/css/select2.min.css")}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
    <script src="{{asset("plugins/select2/js/select2.full.min.js")}}"></script>
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
            $('select[name="approverName"]').empty().append('<option value="'+ 0 +'">'+ 'Select Material Type first' +'</option>');
            $('select[name="materialType"]').on('change', function () {
                var materialTypeId = $(this).val();
                if (materialTypeId && materialTypeId > 0) {
                    $.ajax({
                        url:'/materialTypes/' + materialTypeId,
                        type: 'GET',
                        dataType: "json",
                        success: function (data) {
                            $('select[name="approverName"]').empty().append('<option value="'+ 0 +'">'+ 'Select Approver' +'</option>');
                            $.each(data, function (key, value) {
                                jQuery('select[name="approverName"]').append('<option value="'+ key +'">'+ value +'</option>');
                            })
                        }
                    });
                } else {
                    $('select[name="approverName"]').empty().append('<option value="'+ 0 +'">'+ 'Select Material Type first' +'</option>');
                }
            })
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
@stop
