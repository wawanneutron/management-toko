@extends('layouts.admin')

@section('title')
    Data Buku
@endsection

@section('content')
    <div class="ml-4 mr-3">
      <div class="row">
        <div class="col-12">
          <h5>Data Buku</h5>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
        @endif
      </div> 
      <div class="row mt-2">
        <div class="col-lg-4">
          <form action="{{ route('book.index') }}">
            <h6 class="text-muted font-italic">Search by Buku</h6>
            <div class="input-group">
              <input type="text" class=" form-control">
              <div class=" input-group-append">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-4 mt-3 ml-auto">
          <div class="nav nav-pills card-header-pills">
            <li class="nav-item mr-2 ml-2">
              <a href="{{ route('book.index') }}" class="nav-link btn btn-success {{ Request::get('status') == NULL && Request::path() == 'book' ? 'active' : '' }}">All Book</a>
            </li>
            <li class="nav-item mr-2 ml-2">
              <a href="{{ route('book.index', ['status' => 'publish']) }}" class="nav-link {{ Request::get('status') =='publish' ? 'active' : '' }} ">Published</a>
            </li>
            <li class="nav-item mr-2 ml-2">
              <a href="{{ route('book.index', ['status' => 'draft']) }}" class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}">Draft
                <i class="fas fa-star"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('book-trash') }}" class="nav-link text-danger">Trash
                <i class="fas fa-trash-restore "></i>
              </a>
            </li>
          </div>
        </div>
      </div>
      <table class="table table-responsive mt-5">
        <thead>
          <tr class=" text-center">
            <th>Cover</th>
            <th>Title</th>
            <th>Description</th>
            <th>Stock</th>
            <th>Author</th>
            <th>Status</th>
            <th>Category</th>
            <th>Price</th>
            <th>Action</th>
            
          </tr>
        </thead>
        <tbody>
          @forelse ($items as $item)
            <tr>
              <td class="align-middle ">
                @if ($item->cover)
                    <img src="{{ Storage::url($item->cover) }}" class=" img-thumbnail" width="150px;" height="150px;">
                @else
                    N/A
                @endif
              </td>
              <td class="align-middle" width="190px;">{{ $item->title }}</td>
              <td class="align-middle" width="200px;">{{ $item->description }}</td>
              <td class="align-middle">{{ $item->stock }}</td>
              <td class="align-middle" >{{ $item->author }}</td>
              <td class="align-middle">
                @if ($item->status == 'PUBLISH')
                    <span class="badge badge-success">{{ $item->status }}</span>
                @else
                    <span class="badge badge-warning">{{ $item->status }}</span>
                @endif
              </td>
              <td class="align-middle">
                <ul class="mr-0">
                  @foreach ($item->Categories as $category)
                      <li>{{ $category->name }}</li>
                  @endforeach
                </ul>
              </td>
              <td class="align-middle" width="150px;">Rp. {{ $item->price }}</td>
              <td class="align-middle" width="190px;">
                <a href="{{ route('book.show', $item->id) }}" class=" btn btn-info mr-1 mb-2">
                  <i class=" fas fa-eye"></i>
                </a>
                <a href="{{ route('book.edit', $item->id) }}" class="btn btn-primary mr-1 mb-2">
                  <i class=" fas fa-pencil-alt"></i>
                </a>
                <form action="{{ route('book.destroy', $item->id) }}" method="POST">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger mb-2">
                    <i class=" fas fa-trash "></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td>
                <p>Data kosong...</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
      {{ $items->appends(Request::all())->links() }}
    </div>




@endsection
