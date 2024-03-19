@extends('admin.layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah User</h5>
                            <p class="card-text">{{ $data['user'] }} User</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah User Aktif</h5>
                            <p class="card-text">{{ $data['userActive'] }} User</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Produk</h5>
                            <p class="card-text">{{ $data['product'] }} Produk</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Produk Aktif</h5>
                            <p class="card-text">{{ $data['productActive'] }} Produk</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Produk Terbaru</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-white">Produk</th>
                                        <th class="text-white">Tanggal Dibuat</th>
                                        <th class="text-white">Harga (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['newProduct'] as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ $item->image }}" width="50">
                                                <span>{{ $item->name }}</span>
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($item->created_at)->timezone('Asia/Jakarta')->locale('id_ID')->isoFormat('DD MMMM YYYY'); }}
                                            </td>
                                            <td>
                                               Rp.{{ number_format($item->price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection