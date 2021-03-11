@extends('layouts.admin')

@section('title')
    Data Trash
@endsection

@section('content')
    <div class="ml-4 mr-3">
      <div class="row">
        <div class="col-12">
          <h5>Data Tong sampah</h5>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
        @endif
      </div>
      <div class="row mt-2">
        <div class="col-lg-4">
          <form action="{{ route('book-trash') }}">
            <h6 class="text-muted font-italic">Search by book</h6>
            <div class="input-group">
              <select name="name" id="" class=" custom-select">
                <option value="">-Lihat semua-</option>
                <option value="Buku Sekolah">Buku Sekolah</option>
                <option value="Makanan Ringan">Makanan</option>
                <option value="Baju Sekolah">Baju Sekolah</option>
                <option value="Peralatan Bayi">Peralatan Bayi</option>
                <option value="Peralatan electronic">Electronic</option>
              </select>
              <div class=" input-group-append">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-4 mt-3 ml-auto">
          <div class="nav nav-pills card-header-pills">
            <li class="nav-item mr-2 ml-2">
              <a href="{{ route('book.index') }}" class="nav-link btn btn-success">All Book</a>
            </li>
            <li class="nav-item mr-2 ml-2">
              <a href="{{ route('book-trash', ['status' => 'publish']) }}" class="nav-link {{ Request::get('status') =='publish' ? 'active' : '' }} ">Published</a>
            </li>
            <li class="nav-item mr-2 ml-2">
              <a href="{{ route('book-trash', ['status' => 'draft']) }}" class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}">Draft
                <i class="fas fa-star"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('book-trash') }}" class="nav-link active btn btn-danger">All
                <i class="fas fa-trash-restore"></i>
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
          @forelse ($book_trash as $item)
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
              <td class=" align-middle">
                  <a href="{{ route('book-restore', $item->id) }}" class=" btn btn-success mr-2 mb-2">
                    <i class="fas fa-trash-restore"></i>
                  </a>
                   <button class="btn btn-danger mb-2" data-toggle="modal" data-target="#deleteCategory{{ $item->id }}">
                  <i class="fas fa-trash"></i>
                </button>
                </td>
              </tr>
             <!-- Modal Delete -->
              <div class="modal fade" id="deleteCategory{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategory" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Delete Permanent ?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Do you wont to <span class="text-danger text-bold">delete permanent</span> <br> Buku <span class=" font-weight-bold">{{$item->title}}</span> ?
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="{{ route ('delete-book', $item->id) }}" class="d-inline m-2" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">
                          Delete Permanent
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          @empty
            <tr>
              <td>
                <p>Data kosong...</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
      {{ $book_trash->appends(Request::all())->links() }}
    </div>




@endsection
