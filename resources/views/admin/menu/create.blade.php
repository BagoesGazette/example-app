@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
         <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Menu</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('menu.index') }}">Menu</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title text-right">Form Menu</h4>
                    </div>
                    <form action="{{ route('menu.store') }}" method="POST" autocomplete="off"> @csrf
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="form-group">
                                    <label>Nama <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Masukkan nama menu" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Route <span class="text-danger">*</span></label>
                                    <input type="text" name="route" class="form-control  @error('route') is-invalid @enderror" placeholder="Masukkan nama routing" value="{{ old('route') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Url <span class="text-danger">*</span></label>
                                    <input type="text" name="url" class="form-control  @error('url') is-invalid @enderror" placeholder="Masukkan url" value="{{ old('url') }}">
                                    @error('url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-secondary bg-gradient wafes-effect waves-light"> Simpan Data</button>
                                <a  href="{{ route('menu.index') }}" class="btn btn-light bg-gradient wafes-effect waves-light">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
