@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="card">
      <div class="card-header">
          <div class="row">
              <div class="col-md-6 col-12">
                  <i class="fas fa-solid fa-book-open"></i>
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
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>

                  </tr>
              </thead>
              <tbody>
                @foreach ($diaries as $diary)
                    <tr>
                        <td>{{ $diary->id }}</td>
                      
                        <td>  
                            @if ($diary->author)
                            EOD REPORT for {{ $diary->created_at->format('F d, Y') }} by {{ $diary->author->name }}
                            @else
                            EOD REPORT for {{ $diary->created_at->format('F d, Y') }} by Unknown Author
                            @endif
                        </td>
                        <td>
                                    @if ($diary->status == 1)
                                <span class="badge badge-warning">Pending</span>
                            @else
                                <span class="badge badge-success">Approved</span>
                            @endif
                        </td>
                        <td>
                            <!-- Add any action buttons or links here -->
                            <a href="{{ route('diaries.edit', $diary->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <button onclick="confirmDelete({{ $diary->id }})" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>   
                @endforeach
            </tbody>
          </table>
          <div class="card-footer">
                     @if (session('success_message'))
                        <div class="alert alert-success mb-0">
                            <strong>Success!</strong> {{ session('success_message') }}
                     </div>
                @endif
          </div>
      </div>
  </div>
</div>

@include('admin.users.partials._datatables-scripts')

@endsection