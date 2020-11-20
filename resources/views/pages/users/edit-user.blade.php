@extends('layouts.admin')

@section('title')
    Update users
@endsection

@section('content')
    <div class=" container-fluid">
      <div class="row">
        <div class="coll">
          <h5>Update users</h5>
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
      <form action="{{ route('edit-user.update', $item->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row mt-4 justify-content-center">
          <div class="col-lg-4">
            <label for="">Profile pict</label>
              <div class="form-group">
                @if ($item->avatar)
                  <img src="{{ asset('storage/'.$item->avatar) }}" width="150px;" alt="" class=" img-thumbnail">
                @else
                    <p>No profile pict</p>
                @endif
                <input type="file" class=" form-control">
                <small class=" text-muted">Kosongkan jika tidak ingin mengubah photo</small>
              </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class=" form-control" value="{{ old('name') }} {{ $item->name }}">
            </div>

            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class=" form-control" value="{{ old('username') }} {{ $item->username }}">
            </div>

            <div class="form-group mt-3">
              <input {{ $item->status == 'ACTIVE' ? 'checked' : "" }} value="ACTIVE"
                type="radio" 
                class=" custom-radio" 
                id="active" 
                name="status">
              <label for="status" class="mr-3">Active</label>

              <input {{ $item->status == 'INACTIVE' ? 'checked' : "" }} value="INACTIVE"
                type="radio"
                class=" custom-radio"
                id="inactive"
                name="status">
                <label for="active">InActive</label>
            </div>

            <div class="form-group">
              <input type="checkbox" {{ in_array ('ADMIN', json_decode($item->roles)) ? 'checked' : "" }} name="roles[]" id="" value="ADMIN" class=" custom-checkbox">
              <label for="admin" {{ in_array ('ADMIN', json_decode($item->roles)) ? 'checked' : "" }} class="mr-3">Administrator</label>
              <input type="checkbox" name="roles[]" id="" value="STAFF" class=" custom-checkbox">
              <label for="staff" {{ in_array ('ADMIN', json_decode($item->roles)) ? 'checked' : "" }} class=" mr-3">Staff</label>
              <input type="checkbox" name="roles[]" id="" value="CUSTOMER" class=" custom-checkbox">
              <label for="Customer" {{ in_array ('ADMIN', json_decode($item->roles)) ? 'checked' : "" }} class=" mr-3">Customer</label>
            </div>
         
            <div class="form-group">
              <label for="phone">Phone number</label>
              <input type="text" name="phone" class=" form-control" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class=" form-control" value="{{ old('email') }} {{ $item->email }}">
            </div>
          
            <div class="form-group">
              <label for="address">Address</label>
              <textarea value="{{ old('address') }}" name="address" id="" rows="5" class=" form-control"></textarea>
            </div>
  
            <input type="submit" class="btn btn-success btn-block" value="save"></input>

          </div>
          
        </div>
      </form>
    </div>
@endsection