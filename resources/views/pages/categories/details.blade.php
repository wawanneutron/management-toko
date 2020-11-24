@extends('layouts.admin')

@section('title')
    Create new items
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h5>Details Category <span class=" text-success shadow-lg">{{ $item->name }}</span></h5>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                  <img src="{{ Storage::url($item->image) }}" alt="" width="170px;" height="170px; "class=" rounded-circle">
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                  <div class="text-header mt-2">This details Category</div>
                  <hr>
                  <div class="details-item">
                    <div class="label text-dark">Category</div>
                    <p>{{ $item->name }}</p>

                    <div class="label text-dark">Slug</div>
                    <p>{{ $item->slug }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
