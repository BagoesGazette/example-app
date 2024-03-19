@extends('users.layouts.app')

@push('custom-css')
    <style>
    .carousel-item img {
        width: 100vw;
        height: 500px;
    }
  </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="https://plus.unsplash.com/premium_photo-1667161521640-bba57df66f29?q=80&w=2942&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                      </div>
                      <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1587304883224-b1b6e004a97a?q=80&w=2874&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>


            <div class="col-lg-12 mt-5">
              <h3>Produk Terbaru</h3>
            </div>

            @foreach ($product as $item)
                <div class="col-lg-4 mt-3">
                  <div class="card" style="width: 18rem;">
                    <img src="{{ $item->image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5>{{ $item->name }}</h5>
                      <p class="card-text text-primary">
                        IDR.{{ number_format($item->price, 0, ',', '.') }}
                      </p>
                    </div>
                  </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection