@extends('layouts.admin')

@section('title')
    Categories
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h5>Create ategory</h5>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
        @endif
      </div>
      <div class="row mt-4">
        <div class="col-lg-8">
          <form action="{{ route('categories.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
              <label for="" >Category Name</label>
              <select name="name" id="" class=" custom-select">
                <option value="Buku Sekolah">Buku Sekolah</option>
                <option value="Makanan Ringan">Makanan</option>
                <option value="Baju Sekolah">Baju Sekolah</option>
                <option value="Peralatan Bayi">Peralatan Bayi</option>
                <option value="Peralatan electronic">Electronic</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Image Category</label> <br>
              <div class="btn btn-primary btn-block" onclick="thisFileUpload()">Choice photo...
                <input type="file" name="image" hidden id="file">
              </div>
              <i class="mt-3 text-muted">Choice photo in your file</i>
            </div>
            <div class="form-group mt-4 text-right">
                <button class="btn btn-success px-4" type="submit" value="save">Save as</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- memanggil fungsi file --}}
   <script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
  </script>
@endsection