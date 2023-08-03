@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card">
       <div class="card-body">
        <form action="{{ route('documentations.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="file" name="doc_img" id="doc_img">
            <button type="submit">Save</button>
        </form>
       </div>
       <div class="card-footer">

       </div>

    </div>
    
</div>

    @include('admin.documentations.partials._scripts');

@endsection