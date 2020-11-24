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
        <div class="col-md-12 col-lg-6 d-lg d-none d-lg-block d-md-block">
          <div class="text-right">
            <a href="{{ route('create-users.create') }}">
              <div class="btn btn-success"><i class=" fas fa-plus"></i> Add User</div>
            </a>
          </div>
        </div>
        <div class="col-lg d-lg-none d-md-none">
          <div class="text-right">
            <a href="{{ route('create-users.create') }}">
              <div class="btn btn-sm btn-success"><i class=" fas fa-plus"></i> Add User</div>
            </a>
          </div>
        </div>
      </div>

    <form action="{{ route('data-users.index') }}">
      <div class="row">
        <div class="col-md-6 col-lg-5">
          <div class=" input-group">
            <input type="text" class=" form-control" placeholder="Filter by Email" value="{{ Request::get('keyword') }}" name="keyword">
            
              
          </div> 
        </div>
        <div class="row mt-2 ml-3">
          <div class="col-lg-12 col-md-12">
          <div class="form-group mt-0">
            <input type="radio" {{ Request::get('status') == 'ACTIVE' ? 'checked' : '' }}
            value="ACTIVE"
            name="status"
            class="custom-radio"
            id="active">
            <label for="" class="mr-3">Active</label>
            <input type="radio" {{ Request::get('status') == 'INACTIVE' ? 'checked' : '' }}
            value="INACTIVE"
            name="status"
            class="custom-radio"
            id="active">
            <label for="">In Active</label>
            <input type="submit" value="Filter" class="btn btn-primary ml-3 ">
          </div>
        </div>
        </div>
          
      </div>
     
    </form>
      <div class="row mt-4">
        <div class="col-lg-6">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @elseif (session('status-danger'))
            <div class="alert alert-danger">
              {{ session('status-danger') }}
            </div>
          @endif
        </div>
      </div>
      <table class=" table table-responsive mt-5">  
          <thead>
            <tr>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Avatar Image</th>
              <th>Status</th>
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
                      <img src="{{ asset('storage/' .$user->avatar) }}" width="80px" height="80px" class=" rounded-circle">
                  @else
                      N/A
                  @endif
                </td>
                <td class="align-middle">
                  @if ($user->status == "ACTIVE")
                      <span class="badge badge-success">
                        {{ $user->status }}
                      </span>
                  @elseif($user->status == "INACTIVE")
                      <span class="badge badge-danger">
                        {{ $user->status }}
                      </span>
                  @endif
                </td>
                <td class=" align-middle">
                  <a href="{{ route('edit-user.edit', $user->id ) }}" class=" btn btn-primary mb-1"><i class="fa fa-pencil-alt"></i></a>
                  <a href="{{ route('details-user.show', $user->id ) }}" class=" btn btn-info mb-1"><i class="fa fa-eye"></i></a>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUser{{ $user->id }}">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
              {{-- modal btn-delete--}}  
              <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" role="dialog"     aria-labelledby="deleteUser" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Management Content</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Do you wont to delete <br> <span class=" font-weight-bold">{{$user->name}}</span> ?
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="{{ route ('delete-user.destroy', $user->id) }}" class="d-inline m-2" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">
                          Delete Content
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div> 
            @endforeach
          </tbody>
      </table>
    </div>
    
@endsection