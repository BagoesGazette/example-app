@extends('admin.layouts.app')

@push('plugin-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
         <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Konten</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('content.index') }}">Konten</a></li>
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
                        <h4 class="card-title text-right">Form Konten</h4>
                    </div>
                    <form action="{{ route('content.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data"> @csrf
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="form-group">
                                    <label>Menu <span class="text-danger">*</span></label>
                                    <select name="menu_id" class="form-control select2 @error('menu_id') is-invalid @enderror">
                                        <option selected disabled>Pilih Menu</option>
                                        @foreach ($menu as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('menu_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror 
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi <span class="text-danger">*</span></label>
                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="editor">{{ old('content') }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="formFile" class="form-label">Gambar</label>
                                    <input class="form-control" type="file" name="image" id="formFile">
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

@push('plugin-js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
@endpush

@push('custom-js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
        });
    </script>
@endpush