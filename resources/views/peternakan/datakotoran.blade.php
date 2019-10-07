@extends('layouts.masterdashboard')
@section('css')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('isi')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kotoran Ternak</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Kotoran Ternak</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="text-align: center" id="datapeternak"
                       class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th style="width: 7%;text-align: center; vertical-align: middle">ID</th>
                        <th style="width: 20%; text-align: left; vertical-align: middle">NIK</th>
                        <th style="text-align: center; vertical-align: middle">Nama</th>
                        <th style="text-align: center; vertical-align: middle">Jenis Kelamin</th>
                        <th style="text-align: center; vertical-align: middle">Alamat</th>
                        <th style="text-align: center; vertical-align: middle">Desa</th>
                        <th style="text-align: center; vertical-align: middle">Kecamatan</th>
                        <th style="text-align: center; vertical-align: middle">No Telp</th>
                        <th style="text-align: center; vertical-align: middle">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
@push('script')
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('asetsba2/js/demo/datatables-demo.js')}}"></script>

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            var dt = $('#datapeternak').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                ajax: '{{route('tabel.peternak')}}',--}}
{{--                columns: [--}}
{{--                    {data: 'idpeternak', name: 'idpeternak'},--}}
{{--                    {data: 'nik', name: 'nik'},--}}
{{--                    {data: 'nama', name: 'nama'},--}}
{{--                    {data: 'jeniskelamin', name: 'jeniskelamin'},--}}
{{--                    {data: 'alamat', name: 'alamat'},--}}
{{--                    {data: 'namadesa', name: 'namadesa'},--}}
{{--                    {data: 'namakecamatan', name: 'namakecamatan'},--}}
{{--                    {data: 'telp', name: 'telp'},--}}
{{--                    {data: 'action', name: 'action', orderable: false, searchable: false, align: 'center'},--}}
{{--                ]--}}
{{--            });--}}
{{--            var del = function (id) {--}}
{{--                swal({--}}
{{--                    title: "Apakah anda yakin?",--}}
{{--                    text: "Anda tidak dapat mengembalikan data yang sudah terhapus!",--}}
{{--                    type: "warning",--}}
{{--                    showCancelButton: true,--}}
{{--                    confirmButtonColor: "#DD6B55",--}}
{{--                    confirmButtonText: "Iya!",--}}
{{--                    cancelButtonText: "Tidak!",--}}
{{--                }).then(--}}
{{--                    function (result) {--}}
{{--                        $.ajax({--}}
{{--                            url: "{{route('datapeternak.index')}}/" + id,--}}
{{--                            method: "DELETE",--}}
{{--                        }).done(function (msg) {--}}
{{--                            dt.ajax.reload();--}}
{{--                            swal("Deleted!", "Data sudah terhapus.", "success");--}}
{{--                        }).fail(function (textStatus) {--}}
{{--                            alert("Request failed: " + textStatus);--}}
{{--                        });--}}
{{--                    }, function (dismiss) {--}}
{{--                        // dismiss can be 'cancel', 'overlay', 'esc' or 'timer'--}}
{{--                        swal("Cancelled", "Data batal dihapus", "error");--}}
{{--                    });--}}
{{--            };--}}
{{--            $('body').on('click', '.hapus-data', function () {--}}
{{--                del($(this).attr('data-id'));--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endpush
