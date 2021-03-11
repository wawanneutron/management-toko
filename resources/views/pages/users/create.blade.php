@extends('layouts.admin')

@section('title')
    Create new users
@endsection

@section('content')
    <div class="container">
      <div class="row ">
        <div class="coll">
          <h5>Create New user</h5>
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
      <form action="{{ route('create-users.store') }}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="row mt-4">
            <div class="col-lg-8">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class=" form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" >
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class=" form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group @error('roles') is-invalid @enderror">
              <input type="checkbox" name="roles[]" id="" value="ADMIN" class=" custom-checkbox">
              <label for="admin" class="mr-3">Administrator</label>
              <input type="checkbox" name="roles[]" id="" value="STAFF" class=" custom-checkbox">
              <label for="staff" class=" mr-3">Staff</label>
              <input type="checkbox" name="roles[]" id="" value="CUSTOMER" class=" custom-checkbox">
              <label for="Customer" class=" mr-3">Customer</label>
            </div>
            @error('roles')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="col-lg-8">
            <div class="form-group ">
              <label for="phone">Phone number</label>
              <input type="text" name="phone" class=" form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
              @error('phone')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class=" form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div> 
          <div class="col-lg-8">
            <div class="form-group ">
              <label for="address">Address</label>
              <textarea  name="address" id="" rows="5" class=" form-control @error('address') is-invalid @enderror">{{ old('address') }}
              </textarea>
              @error('address')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group ">
              <label for="password">Password</label>
              <input type="password" name="password" class=" form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" autocomplete="off">
              @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
              @enderror
            </div>
          </div>
          <div class="col-lg-8">
            <label for="">Avatar Image</label>
            <input type="file" name="avatar" class=" form-control @error('avatar') is-invalid @enderror">
            @error('avatar')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
            @enderror
          </div>
          <div class="col-lg-8 mt-4">
            <input type="submit" class="btn btn-success btn-block" value="save"></input>
          </div>
        </div>
      </form>
    </div>
@endsection