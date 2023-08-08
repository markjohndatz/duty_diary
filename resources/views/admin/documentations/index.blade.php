@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card">
        <form action="{{ route('documentations.store') }}" method="POST" enctype="multipart/form-data">
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
                    @if(isset($docs) && $docs->count() > 0)
                    @foreach ($docs as $doc)
                        <div class="col-md-3 col-sm-4 col-12 shadow-sm position-static mt-3">
                            <a href="{{ asset('storage/images/'.$doc->image) }}" data-lightbox="lightbox-img" data-title="{{ $doc->caption }}" data-alt="{{ $doc->caption }}">
                                <img src="{{ asset('storage/images/'.$doc->image) }}" alt="{{ $doc->caption }}" class="img-fluid">
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger">Sorry, there are no files or documentations at the moment</div>
                @endif
                </div>
               <div class="card-footer">

               </div>
        </form>       
    </div>


</div>


@include('admin.documentations.partials._modal')

@include('admin.documentations.partials._scripts')
    
@endsection