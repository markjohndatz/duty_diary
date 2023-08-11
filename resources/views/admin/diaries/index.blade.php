@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="card">
      <div class="card-header">
          <div class="row">
              <div class="col-md-6 col-12">
                  <i class="fas fa-solid fa-users"></i>
                  Diaries
              </div>
              <div class="col-md-6 col-12 text-right">
                <a href="{{ route('diaries.create') }}" class="btn btn-sm btn-primary">New Diary</a>
            </div>
          </div>
      </div>
      <div class="card-body p-0">
          <table class="table table-hover mb-0" id="diaries-table">
              <thead>
                  <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Title</th>
                      <th scope="col">Author</th>
                      <th scope="col">Supervisor</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>

                  </tr>
              </thead>
              <tbody>

              </tbody>
          </table>
          <div class="card-footer">
              @if (isset($user_name))
                  <div class="alert alert-success mb-0">
                      <strong>Success!</strong> {{ $user_name }}'s information has been successfully updated.
                  </div>
              @endif
          </div>
      </div>
  </div>
</div>

@include('admin.users.partials._datatables-scripts')

@endsection