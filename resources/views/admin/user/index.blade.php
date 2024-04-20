@extends('admin.layouts.app')

@push('plugin-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Users</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Users</li>
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
                        <h4 class="card-title text-right">Daftar Users</h4>
                        <a href="{{ route('users.create') }}"  class="btn btn-secondary bg-gradient waves-effect waves-light">Tambah Data</a>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-hover table-striped datatable">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No.Telepon</th>
                                    <th>Aksi</th>
                                </thead>
                            </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<!-- container-fluid -->
@endsection

@push('plugin-js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
@endpush

@push('custom-js')
    <script>
        var table = $('.datatable').DataTable({
            serverSide: true,
            ordering: true,
            info: true,
            filter: true,
            ajax:  {
                url : "{{ route('users.index') }}",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'action', name: 'action'},
            ],
        });

        function Delete(id) {
            Swal.fire({
                html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Apakah anda yakin ?</h4><p class="text-muted mx-4 mb-0">Menghapus data ini ?</p></div></div>',
                showCancelButton: !0,
                confirmButtonClass:"btn btn-primary bg-gradient wafes-effect waves-light w-xs me-2 mb-1",
                confirmButtonText:"Ya, Hapus Data!",
                cancelButtonText:"Batalkan!",
                cancelButtonClass:"btn btn-danger bg-gradient wafes-effect waves-light w-xs mb-1",
                buttonsStyling:!1,
                showCloseButton:!0
            }).then(function(isConfirm) {
                console.log(isConfirm)
                if (isConfirm.isConfirmed == true) {
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
                            console.log(response);
                            if (response.status === "success") {
                                Swal.fire({
                                    html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Sukses !</h4><p class="text-muted mx-4 mb-0">Berhasil hapus data ini!</p></div></div>',
                                    timer: 5000,
                                    showCancelButton:!0,showConfirmButton:!1,
                                    cancelButtonClass:"btn btn-primary w-xs mb-1",
                                    cancelButtonText:"Tutup",
                                    buttonsStyling:!1,showCloseButton:!0
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Gagal !</h4><p class="text-muted mx-4 mb-0">Data tidak berhasil dihapus</p></div></div>',
                                    showCancelButton:!0,showConfirmButton:!1,
                                    cancelButtonClass:"btn btn-primary w-xs mb-1",
                                    cancelButtonText:"Tutup",
                                    buttonsStyling:!1,showCloseButton:!0
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                } else if(isConfirm.isConfirmed == false) {
                    console.log('cancel')
                }
            })
        }
    </script>
@endpush