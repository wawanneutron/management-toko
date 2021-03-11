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
        
      </div>
      <table class="table table-responsive mt-5">
        <thead>
          <tr class=" text-center">
            <th>Invoice Number</th>
            <th>Status</th>
            <th>Buyer</th>
            <th>Total Quantity</th>
            <th>Order Date</th>
            <th>Total Price</th>
            <th>Bok Title</th>
            <th>Action</th>
            
          </tr>
        </thead>
        <tbody>
          @forelse ($items as $item)
            <tr>
              <td class="align-middle">{{ $item->invoice_number }}</td>
              
              <td class="align-middle">
                @if ($item->status == 'SUBMIT')
                   <span class="badge badge-warning text-light">{{ $item->status }}</span>
                @elseif($item->status == 'PROCESS')
                   <span class="badge badge-info text-light">{{ $item->status }}</span>             
                @elseif($item->status == 'FINISH')
                    <span class="badge badge-success text-light">{{ $item->status }}</span>     
                @elseif($item->status == 'CANCEL')
                <span class="badge badge-danger text-light">{{ $item->status }}</span>   
                @endif
              </td>
              <td class="align-middle">
                <span>{{ $item->user->name }} <br> {{ $item->user->email }}</span>

              </td>
              <td class="align-middle">{{ $item->totalQuantity }} pc (s)</td>
              <td class="align-middle">{{ $item->created_at }}</td>
              <td class="align-middle">{{ $item->total_price }}</td>
            
              <td class="align-middle" width="190px;">
                <a href="{{ route('orders.show', $item->id) }}" class=" btn btn-info mr-1 mb-2">
                  <i class=" fas fa-eye"></i>
                </a>
                <a href="{{ route('book.edit', $item->id) }}" class="btn btn-primary mr-1 mb-2">
                  <i class=" fas fa-pencil-alt"></i>
                </a>
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
