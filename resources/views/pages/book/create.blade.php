@extends('layouts.admin')

@section('footer-script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
      $('#categories').select2({
        ajax:{
          url:'http://localhost:8000/ajax/categories/search',
          processResults:function(data){
            return {
              results:data.map(function(item){
                return {
                  id:item.id,
                  text:item.name
                  }
              })
            }
          }
        }
      });
      
  </script>
@endsection

@section('title')
    Categories
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h5>Create book</h5>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
        @endif
      </div>
      <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mt-4">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class=" form-control" name="title" placeholder="Book title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <input type="text" class=" form-control" name="description" placeholder="Book description" value="{{ old('description') }}">
            </div>
            <div class="form-group">
              <label for="stock">Stock</label>
              <input type="number" class=" form-control" name="stock" placeholder="Book stock" value="{{ old('stock') }}">
            </div>
            <div class="form-group">
              <label for="author">Author</label>
              <input type="text" class=" form-control" name="author" placeholder="Book author" value="{{ old('author') }}">
            </div>
            <div class="form-group">
              <label for="publisher">Publisher</label>
              <input type="text" class=" form-control" name="publisher" placeholder="Book publisher" value="{{ old('publisher') }}">
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" class=" form-control" name="price" placeholder="Book price" value="{{ old('price') }}">
            </div>
            <div class="row mt-4">
              <div class="col-md-6 col-lg-6">
                <button class="btn btn-primary btn-block mb-2" name="save_action" value="PUBLISH">Publish</button>
              </div>
              <div class="col-md-6 col-lg-6">
                <button class="btn btn-secondary btn-block" name="save_action" value="DRAFT">Save as draft</button>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="categories">Category</label>
              <select 
                name="categories[]"
                multiple
                id="categories"
                class="form-control">
              </select>
            </div>
            
            <div class="form-group">
              <label for="cover">Cover</label>
              <input type="file" name="cover" class=" form-control">
            </div>
          </div>
        </div>
      </form>
    </div>

    

@endsection