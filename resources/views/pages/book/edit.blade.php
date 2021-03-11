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

     var categories = {!! $item->categories !!}

       categories.forEach(function(category){

         var option = new Option(category.name, category.id, true, true);
         $('#categories').append(option).trigger('change');
         
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
          <h5>Edit book</h5>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
        @endif
      </div>
      <form action="{{ route('book.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row mt-4">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class=" form-control" name="title"  value="{{ $item->title }}">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea name="description"rows="5" class="form-control">{{ $item->description }}</textarea>
            </div>
            <div class="form-group">
              <label for="stock">Stock</label>
              <input type="number" class=" form-control" name="stock" placeholder="Book stock" value="{{ $item->stock }}">
            </div>
            <div class="form-group">
              <label for="author">Author</label>
              <input type="text" class=" form-control" name="author" placeholder="Book author" value="{{ $item->author }}">
            </div>
            <div class="form-group">
              <label for="publisher">Publisher</label>
              <input type="text" class=" form-control" name="publisher" placeholder="Book publisher" value="{{ $item->publisher }}">
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" class=" form-control" name="price" placeholder="Book price" value="{{ $item->price }}">
            </div>
            <div class="row mt-4">
              <div class="col-md-6 col-lg-6">
                <button class="btn btn-primary btn-block mb-2" name="save_action">Update</button>
              </div>
              
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class=" custom-select">
                <option value="PUBLISH" {{ $item->status == 'PUBLISH' ? 'selected' : '' }}>Publish</option>
                <option value="DRAFT" {{ $item->status == 'DRAFT' ? 'selected' : '' }}>Draft</option>
              </select>
            </div>
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
              <img src="{{ Storage::url($item->cover) }}" alt="" class=" img-thumbnail">
              <label for="cover">Cover</label>
              <input type="file" name="cover" class=" form-control">
            </div>
          </div>
        </div>
      </form>
    </div>

    

@endsection