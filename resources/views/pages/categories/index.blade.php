@extends('layouts.admin')

@section('title')
    Data Category
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h5>Data Category</h5>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
        @endif
      </div>
      <div class="row mt-2">
        <div class="col-lg-4">
          <form action="{{ route('categories.index') }}">
            <h6 class="text-muted font-italic">Search by category</h6>
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
        <div class="col-lg-3 mt-3 ml-auto">
          <div class="nav nav-pills card-header-pills">
            <li class="nav-item mr-2">
              <a href="{{ route('categories.index') }}" class="nav-link active">Published</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categories-trash') }}" class="nav-link">Trash
                <i class="fas fa-trash-restore"></i>
              </a>
            </li>
          </div>
        </div>
      </div>
      <table class="mt-5 table table-responsive" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($items as $item)
              <tr>
                <td class=" align-middle">{{ $item->name }}</td>
                <td class=" align-middle">{{ $item->slug }}</td>
                <td class=" align-middle">
                  @if ($item->image)
                      <img src="{{ asset('storage/' .$item->image) }}" width="80px" height="80px">
                  @else
                      N/A
                  @endif
                </td>
                <td class=" align-middle">
                  <a href="{{ route('categories.show', $item->id) }}" class=" btn btn-primary mb-2">
                    <i class=" fas fa-eye"></i>
                  </a>
                  <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-info mb-2">
                    <i class=" fas fa-edit"></i>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Do you wont to delete <br> Category <span class=" font-weight-bold">{{$item->name}}</span> ?
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route ('categories.destroy', $item->id) }}" class="d-inline m-2" method="POST">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger">
                        Delete
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @empty
              <tr>
                <td colspan="7" class="text-center">
                  Opps data kosong...
                </td>
              </tr>

            
          @endforelse
        </tbody>
      </table>
      {{ $items->appends(Request::all())->links() }}
    </div>




@endsection
