@extends('layouts.masterdashboard')
@section('css')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('isi')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kepemilikan Ternak</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    @endif
    <form method="POST" action="{{route('kepemilikan.store')}}" role="form">
        @csrf
        <label style="color:black">NIK</label>
        <input type="text" class="form-control form-control-user" id="nik" name="nik" aria-describedby="emailHelp"
               placeholder="" required>
        <button type="button" id="tb_nik">Cek ID</button>
        <br>
        <label style="color:black">Nama Peternak</label>
        <input type="text" class="form-control form-control-user" value="" id="nama" name="nama"
               aria-describedby="emailHelp" disabled>
        <label style="color:black">Jenis Ternak</label>
        <select class="form-control show-tick" name="idjenis" required>
            <option value="">-- Please select --</option>
            @foreach($jenisternak as $values)
                <option value="{{$values->idjenis}}">{{$values->jenisternak}}</option>
            @endforeach
        </select>
        <label style="color:black">Jumlah Ternak (ekor)</label>
        <input type="text" class="form-control form-control-user" id="jumlah" name="jumlah" aria-describedby="emailHelp"
               placeholder="" required>
        <label style="color:black">Lokasi Ternak</label>
        <input type="text" class="form-control form-control-user" id="lokasi" name="lokasi" aria-describedby="emailHelp"
               placeholder="" required>


        <input type="text" class="form-control form-control-user" id="idpeternak" name="idpeternak"
               aria-describedby="emailHelp" placeholder="ID PETERNAK" required hidden>


        <br>
        <button type="submit" class="btn-sm btn-primary shadow-sm">
            SIMPAN
        </button>

    </form>
    <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kepemilikan Ternak</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="text-align: center" id="datapemilik"
                       class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th style="width: 7%;text-align: center; vertical-align: middle">ID Pemilik</th>
                        <th style="text-align: center; vertical-align: middle">Nama</th>
                        <th style="text-align: center; vertical-align: middle">Alamat</th>
                        <th style="text-align: center; vertical-align: middle">Jenis Ternak</th>
                        <th style="text-align: center; vertical-align: middle">Jumlah Ternak</th>
                        <th style="text-align: center; vertical-align: middle">Lokasi Ternak</th>
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

    <script>
        $(document).ready(function () {
            var dt = $('#datapemilik').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('tabel.kepemilikan')}}',
                columns: [{
                    data: 'idkepemilikan',
                    name: 'idkepemilikan'
                },
                    {
                        data: 'namapeternak',
                        name: 'namapeternak'
                    },
                    {
                        data: 'alamatpeternak',
                        name: 'alamatpeternak'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis'
                    },
                    {
                        data: 'jumlahternak',
                        name: 'jumlahternak'
                    },
                    {
                        data: 'lokasiternak',
                        name: 'lokasiternak'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        align: 'center'
                    },
                ]
            });
        });

        $('#tb_nik').on('click', function (e) {
            e.preventDefault();

            var kode = $("#nik").val();
            $.ajax({
                url: "{{url('/ceknik')}}/" + kode,
                type: 'GET',
                datatype: 'json',

                error: function (jqXHR, exception) {
                    swal("Data tidak ditemukan", "", "error");
                    $('#nama').val("");
                },
                success: function (x) {
                    $.each(x, function (index, z) {
                        $('#nama').val(z.nama);
                        $('#idpeternak').val(z.idpeternak);
                    });
                },
            });
        });
    </script>
@endpush
