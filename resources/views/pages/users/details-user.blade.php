@extends('layouts.admin')

@section('title')
    Create new users
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h5>Details User <span class=" text-success shadow-lg">{{ $user->username }}</span></h5>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                  <img src="{{ Storage::url($user->avatar) }}" alt="" width="170px;" height="170px; "class=" rounded-circle">
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                  <div class="text-header mt-2">This details user</div>
                  <hr>
                  <div class="details-user">
                    <div class="label text-dark">Name</div>
                    <p>{{ $user->name }}</p>

                    <div class="label text-dark">Email</div>
                    <p>{{ $user->email }}</p>

                    <div class="label text-dark">Phone number</div>
                    <p>{{ $user->phone }}</p>

                    <div class="label text-dark">Address</div>
                    <p>{{ $user->address }}</p>

                    <div class="label text-dark">Roless</div>
                    @foreach (json_decode($user->roles) as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
