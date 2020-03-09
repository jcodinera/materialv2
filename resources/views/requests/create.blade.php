@extends('layouts.app')

@section("title", "Create Request")

@section('content')
    <div class="container offset-sm-1 col-sm-10 offset-sm-1">
        <form action="{{route("requests.store")}}" method="POST">
            @csrf
            {{-- Requestor --}}
            <div class="form-group row">
                <label for="requestor" class="col-sm-2 col-form-label">REQUESTOR :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error("requestor") is-invalid @enderror" id="requestor" name="requestor">
                    @error("requestor")
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            {{-- Material Type --}}
            <div class="form-group row">
                <label for="materialType" class="col-sm-2 col-form-label">Material Type :</label>
                <div class="col-sm-10">
                    <select class="form-control select2 select2-hidden-accessible @error("materialType") is-invalid @enderror"
                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="materialType">
                            <option selected data-select2-id="0"></option>
{{--                        @foreach($icmMaterialTypes as $icmMaterialType)--}}
                            <option data-select2-id="1">Alabama</option>
{{--                        @endforeach--}}
                    </select>
                    @error("materialType")
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            {{-- Long Description --}}
            <div class="form-group row mt-4 ml-0">
                <label for="longDescription">Long Description: (Please use catalog guide)</label>
                <textarea class="form-control mr-3 @error("longDescription") is-invalid @enderror" id="longDescription" rows="5" name="longDescription"></textarea>
                @error("longDescription")
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="row">
                <div class="card m-4" style="width: 50em">
                    <div class="card-header text-bold">Naming Conventions:</div>
                    <div class="card-body py-2">
                        <div class="row text-primary">
                            <div class="col-sm-2">HW:</div>
                            <div class="col-sm-10">
                                (Primary Component) brand/model/CPU/HDD/memory/opt drive/OS
                            </div>
                        </div>
                        <div class="row text-primary">
                            <div class="offset-sm-2 col-sm-10 mt-0">
                                (Secondary Component) wlan/security/camera/screen type & size/software/input devices
                            </div>
                        </div>
                        <div class="row text-success">
                            <div class="col-sm-2">SWP:</div>
                            <div class="col-sm-10">
                                brand/model/general description
                            </div>
                        </div>
                        <div class="row" style="color: magenta">
                            <div class="col-sm-2">CSD:</div>
                            <div class="col-sm-10">
                                brand/model/general description
                            </div>
                        </div>
                        <div class="row text-danger">
                            <div class="col-sm-2">CAC:</div>
                            <div class="col-sm-10">
                                brand/PN [or] model#/capacity/where used
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Short Description --}}
            <div class="form-group row mt-4 ml-0">
                <label for="shortDescription">Short Description: (Please follow the given naming convention)</label>
                <textarea class="form-control mr-3 @error("shortDescription") is-invalid @enderror" id="shortDescription" rows="3" name="shortDescription"></textarea>
                @error("shortDescription")
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="row">
                <div class="card m-4" style="width: 50em">
                    <div class="card-header text-bold">Naming Conventions:</div>
                    <div class="card-body py-2">
                        <div class="row text-primary">
                            <div class="col-sm-2">HW:</div>
                            <div class="col-sm-10">
                                brand/model/CPU/HDD/memory/opt drive/OS
                            </div>
                        </div>
                        <div class="row text-success">
                            <div class="col-sm-2">SWP:</div>
                            <div class="col-sm-10">
                                brand/model/general description
                            </div>
                        </div>
                        <div class="row" style="color: magenta">
                            <div class="col-sm-2">CSD:</div>
                            <div class="col-sm-10">
                                brand/model/general description
                            </div>
                        </div>
                        <div class="row text-danger">
                            <div class="col-sm-2">CAC:</div>
                            <div class="col-sm-10">
                                brand/PN [or] model#/capacity/where used
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mfr Part No. --}}
            <div class="form-group row mt-3">
                <label for="mfrPartNo" class="col-sm-2 col-form-label">Mfr Part No:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error("mfrPartNo") is-invalid @enderror" id="mfrPartNo" name="mfrPartNo">
                    @error("mfrPartNo")
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            {{-- Buy Price --}}
            <div class="form-group row mt-3">
                <label for="buyPrice" class="col-sm-2 col-form-label">Buy Price :</label>
                <div class="col-sm-10">
                    <input type="number" step=".000001" class="form-control @error("buyPrice") is-invalid @enderror" id="buyPrice" name="buyPrice">
                    @error("buyPrice")
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            {{-- Date Requested --}}
            <div class="form-group row mt-3">
                <label for="buyPrice" class="col-sm-2 col-form-label">Date Requested :</label>
                <div class="col-sm-10">
                    <p class="text-danger pt-2">{{date('Y/m/d H:m:s A')}}</p>
                </div>
            </div>

            {{-- Approver Name --}}
            <div class="form-group row">
                <label for="approverName" class="col-sm-2 col-form-label">Approver Name :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error("approverName") is-invalid @enderror" id="approverName" name="approverName">
                    @error("approverName")
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            {{-- Reference Doc --}}
            <div class="form-group row">
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
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 100,
                width: "100%"
            });
        });
    </script>
@stop
