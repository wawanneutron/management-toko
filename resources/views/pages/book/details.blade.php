@extends('layouts.admin')

@section('title')
    Details
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h5>Details Book <span class=" text-success shadow-lg">{{ $item->title }}</span></h5>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row mb-3 ml-0">
                <div class="col-12"></div>
                <div class="text-header mt-2">This details Category</div>
                  <hr>
              </div>
              <div class="row">
                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                  <img src="{{ Storage::url($item->cover) }}" alt="" width="170px;" height="170px;">
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-4">
                  
                  <div class="details-item">
                    <div class="label text-dark">Title</div>
                    <p>{{ $item->title }}</p>

                    <div class="label text-dark">Description</div>
                    <p>{{ $item->description }}</p>

                     <div class="label text-dark mt-2">Category</div>
                    <ol class="mt-2">
                      @foreach ($item->Categories as $category)
                          <li>{{ $category->name }}</li>
                      @endforeach
                    </ol>

                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="label text-dark">Stock</div>
                    <p>{{ $item->stock }}</p>

                    <div class="label text-dark">Status</div>
                    @if ($item->status == 'DRAFT')
                        <span class="badge badge-warning">{{ $item->status }}</span>
                    @else
                        <span class="badge badge-success">{{ $item->status }}</span>
                    @endif

                    <div class="label text-dark mt-3">Harga</div>
                    <p>Rp. {{ $item->price }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
