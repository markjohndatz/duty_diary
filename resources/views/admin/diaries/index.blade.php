@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
            <div class="col-md-6 col-12">
                <i class="fas fa-solid fa-book"></i>
                Diaries
            </div>
            <div class="col-md-6 col-12 text-right">
                <a href="{{ route('diaries.create') }}" class="btn btn-sm btn-primary">New Diary</a>
            </div>
        </div>
      </div>
      <div class="card-body">
        
      </div>
        <div class="card-footer">
      </div>
</div>
@endsection