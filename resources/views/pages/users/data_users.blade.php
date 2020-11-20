@extends('layouts.admin')

@section('title')
    Create new users
@endsection

@section('content')
    <div class="container">
      <div class="row mb-3">
        <div class="col-lg-6">
          <h5>Data Users</h5>
        </div>
        <div class="col text-right">
          <a href="{{ route('create-users.create') }}">
            <div class="btn btn-success">Add User</div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
        </div>
      </div>
      <table class=" table table-responsive">  
          <thead>
            <tr>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Avatar Image</th>
              <th>Aactions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <td class=" align-middle">{{ $user->name }}</td>
                <td class=" align-middle">{{ $user->username }}</td>
                <td class=" align-middle">{{ $user->email }}</td>
                <td class=" align-middle">
                  @if ($user->avatar)
                      <img src="{{ asset('storage/' .$user->avatar) }}" style=" width:80px;" alt="">
                  @else
                      N/A
                  @endif
                </td>
                <td class=" align-middle">
                  <a href="{{ route('edit-user.edit', $user->id ) }}" class=" btn btn-primary">Edit</a>
                </td>
                <td class=" align-middle">
                  <a href="" class=" btn btn-danger">Delete</a>
                </td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
@endsection