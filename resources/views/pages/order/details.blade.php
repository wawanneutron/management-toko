@extends('layouts.admin')

@section('title')
    Details
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h5>Details Order <span class=" text-success shadow-lg"></span></h5>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row mb-3 ml-0">
                <div class="col-12"></div>
                <div class="text-header mt-2">This details Order</div>
                  <hr>
              </div>
              <div class="row">
                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                  <img src="{{ Storage::url($detail_order->cover) }}" alt="" width="170px;" height="170px;">
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-4">
                  
                  <div class="details-item">
                    <div class="label text-dark">Invoice Number</div>
                    <p>{{ $detail_order->invoice_number }}</p>

                    <div class="label text-dark">Status</div>
                    <p>{{ $detail_order->status }}</p>
                    <div class="label text-dark">Buyer</div>
                    <p>{{ $detail_order->user->name }}</p>
                    <p>{{ $detail_order->user->email }}</p>
                    <div class="label text-dark">Book Title</div>
                    <p></p>
                     
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="label text-dark">Total Quantity</div>
                    <p></p>

                  <div class="label text-dark">Order Date</div>
                    <p>{{ $detail_order->created_at }}</p>

                  <div class="label text-dark mt-3">Total Quantity</div>
                  <p>{{ $detail_order->totalQuantity }}</p>

                  <div class="label text-dark mt-3">Total Price</div>
                  <p>Rp. {{ $detail_order->total_price }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
