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
              <input type="text" name="name" class=" form-control" value="{{ old('name') }}">
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class=" form-control" value="{{ old('username') }}">
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group">
              <input type="checkbox" name="roles[]" id="" value="ADMIN" class=" custom-checkbox">
              <label for="admin" class="mr-3">Administrator</label>
              <input type="checkbox" name="roles[]" id="" value="STAFF" class=" custom-checkbox">
              <label for="staff" class=" mr-3">Staff</label>
              <input type="checkbox" name="roles[]" id="" value="CUSTOMER" class=" custom-checkbox">
              <label for="Customer" class=" mr-3">Customer</label>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group">
              <label for="phone">Phone number</label>
              <input type="text" name="phone" class=" form-control" value="{{ old('phone') }}">
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class=" form-control" value="{{ old('email') }}">
            </div>
          </div> 
          <div class="col-lg-8">
            <div class="form-group">
              <label for="address">Address</label>
              <textarea value="{{ old('address') }}" name="address" id="" rows="5" class=" form-control"></textarea>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class=" form-control" value="{{ old('password') }}">
            </div>
          </div>
          <div class="col-lg-8">
            <label for="">Avatar Image</label>
            <input type="file" name="avatar" class=" form-control">
          </div>
          <div class="col-lg-8 mt-4">
            <input type="submit" class="btn btn-success btn-block" value="save"></input>
          </div>
        </div>
      </form>
    </div>
@endsection