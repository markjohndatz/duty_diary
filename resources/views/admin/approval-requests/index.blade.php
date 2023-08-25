@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 col-12">
                    <i class="fas fa-solid fa-file-circle-check"></i>
                    Approval Requests
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-hover" id="approval-requests-table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                        <th scope="col">Action</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            @if(isset($diaryApproved))
                <div class="alert alert-success">
                    {{ $diaryApproved }}
                </div>
            @elseif(isset($diaryRejected))
                <div class="alert alert-danger">
                    {{ $diaryRejected }}
                </div>
            @endif
        </div>
    </div>
    @include('admin.approval-requests.partials._datatables-script')
</div>
@endsection