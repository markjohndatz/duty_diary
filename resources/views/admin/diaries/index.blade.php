@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">Diaries</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Action</th>
                    <th scope="col">Title</th>
                    <th scope="col">Approval</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td><a href="" class="btn btn-warning">Edit</a>
                      <button class="btn btn-danger">Delete</button>
                    </td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr> 
                  <tr>
                    <th scope="row">2</th>
                    <td><button class="btn btn-warning">Edit</button>
                      <button class="btn btn-danger">Delete</button>
                    </td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td><button class="btn btn-warning">Edit</button>
                      <button class="btn btn-danger">Delete</button>
                    </td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
        </div>
        <div class="card-footer"></div>
      </div>
</div>
@endsection