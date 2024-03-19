@extends('admin.layouts.app')

@push('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Manajemen User</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title text-right">Daftar Users</h4>
                    <button  class="btn btn-primary create" data-toggle="modal" data-target="#exampleModal">Tambah Data</button>
                </div>  
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                          </button>
                          {{ Session::get("success") }}.
                        </div>
                    </div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No.Telepon</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
            <h5 class="modal-title w-100" id="exampleModalLabel">Tambah User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('users.store') }}" method="POST" autocomplete="off"> @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan nama">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Masukkan nomor telepon">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-block">SIMPAN</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('custom-js')
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $(".datatable").dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('users.index') }}",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'},
            ],
        });

        function Delete(id, name) {
            swal({
                title: 'Konfirmasi Hapus',
                text: 'Apakah kamu yakin menghapus "'+ name +'" !',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete == true) {
                    //ajax delete
                    jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: "{{ route('users.index') }}/"+id,
                        data: {
                            id : id
                        },
                        type: 'DELETE',
                        success: function (response) {
                            if (response.status === "success") {
                                swal({
                                    text: 'Berhasil menghapus data "'+ name +'" !',
                                    icon: 'success',
                                }).then(function() {
                                    window.location = "{{ url("users") }}";
                                });
                            } else {
                                swal({
                                    text: 'Gagal menghapus data "'+ name +'" !',
                                    icon: 'error',
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                } else if(isConfirm.isConfirmed == false) {
                    console.log('cancel')
                }
            });
        }
    </script>
@endpush