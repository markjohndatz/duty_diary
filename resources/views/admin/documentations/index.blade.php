@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card">
        <form action="{{ route('documentations.store') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="card-header">
                    <div class="row">
                            <div class="col-md-10 col-12">
                                <h3>Documentations</h3>
                            </div>
                            <div class="col-md-2 col-12">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newDocumentation">
                                    New Documentations
                                </button>
                            </div>
                    </div>       
                </div>
                <div class="card-body row ">
                    <div class="col-md-4 col-12 ">
                        <img src="{{ asset ('storage/images/dota-2-logo.0-1691036824.jpg') }}" alt="logo" class="img-fluid">
                    </div>
                    <div class="col-md-4 col-12">
                       <img src="{{ asset ('storage/images/dota-2-logo.0-1691036824.jpg') }}" alt="logo" class="img-fluid">
                     </div>
                    <div class="col-md-4 col-12">
                       <img src="{{ asset ('storage/images/dota-2-logo.0-1691036824.jpg') }}" alt="logo" class="img-fluid">
                     </div>
                </div>
               <div class="card-footer">

               </div>
        </form>       
    </div>


</div>


@include('admin.documentations.partials._modal')
@include('admin.documentations.partials._scripts')

    
@endsection