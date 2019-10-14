@extends('layouts.masterdashboard')
@section('css')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('isi')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Peternak</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    @endif
    <form method="POST" action="{{route('datapeternak.store')}}" role="form">
        @csrf
        <label style="color:black">NIK</label>
        <input type="text" class="form-control form-control-user" id="nik" name="nik"
               aria-describedby="emailHelp" placeholder="" required>
        @if ($errors->any())
            {!! $errors->first('nik', '<p style="font-size: 12px; color:red">ERROR! input NIK Harus Berupa Angka</p>') !!}
        @endif
        <label style="color:black">Nama Peternak</label>
        <input type="text" class="form-control form-control-user" value="{{old('nama')}}" id="nama" name="nama"
               aria-describedby="emailHelp" placeholder="" required>
        <input type="text" class="form-control form-control-user" id="id" name="id" aria-describedby="emailHelp"
               hidden>
        <label style="color:black">Jenis Kelamin</label>
        <select class="form-control show-tick" id="jk" value="{{old('jk')}}" name="jk" required>
            <option value="">-- Please select --</option>
            <option value="Laki-Laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        <label style="color:black">Alamat</label>
        <input type="text" class="form-control form-control-user" value="{{old('alamat')}}" id="alamat" name="alamat"
               aria-describedby="emailHelp" placeholder="" required>
        <label style="color:black">Desa</label>
        <select class="form-control show-tick" value="{{old('iddesa')}}" id="desa" name="iddesa" required>
            <option value="">-- Please select --</option>
            @foreach($desa as $values)
                <option value="{{$values->iddesa}}">{{$values->namadesa}}</option>
            @endforeach
        </select>
        <label style="color:black">Kecamatan</label>
        <select class="form-control show-tick" value="{{old('idkecamatan')}}" name="idkecamatan" required>
            <option value="">-- Please select --</option>
            @foreach($kecamatan as $values)
                <option value="{{$values->idkecamatan}}">{{$values->kecamatan}}</option>
            @endforeach
        </select>
        <label style="color:black">No Telp</label>
        <input type="text" class="form-control form-control-user" id="telp" value="{{old('telp')}}" name="telp"
               aria-describedby="emailHelp" placeholder="" required>
        @if ($errors->any())
            {!! $errors->first('telp', '<p style="font-size: 12px; color:red">ERROR! input No Telp Harus Berupa Angka</p>') !!}
        @endif

        <br>
        <button id="simpan" type="submit" class="btn-sm btn-primary shadow-sm">
            SIMPAN
        </button>

    </form>
    <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Peternak</h6>
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

    <script>
        $(document).ready(function () {
            var dt = $('#datapeternak').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('tabel.peternak')}}',
                columns: [
                    {data: 'idpeternak', name: 'idpeternak'},
                    {data: 'nik', name: 'nik'},
                    {data: 'nama', name: 'nama'},
                    {data: 'jeniskelamin', name: 'jeniskelamin'},
                    {data: 'alamat', name: 'alamat'},
                    {data: 'namadesa', name: 'namadesa'},
                    {data: 'namakecamatan', name: 'namakecamatan'},
                    {data: 'telp', name: 'telp'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, align: 'center'},
                ]
            });
            var del = function (id) {
                swal({
                    title: "Apakah anda yakin?",
                    text: "Anda tidak dapat mengembalikan data yang sudah terhapus!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Iya!",
                    cancelButtonText: "Tidak!",
                }).then(
                    function (result) {
                        $.ajax({
                            url: "{{route('datapeternak.index')}}/" + id,
                            method: "DELETE",
                        }).done(function (msg) {
                            dt.ajax.reload();
                            swal("Deleted!", "Data sudah terhapus.", "success");
                        }).fail(function (textStatus) {
                            alert("Request failed: " + textStatus);
                        });
                    }, function (dismiss) {
                        // dismiss can be 'cancel', 'overlay', 'esc' or 'timer'
                        swal("Cancelled", "Data batal dihapus", "error");
                    });
            };
            $('body').on('click', '.hapus-data', function () {
                del($(this).attr('data-id'));
            });
            $('body').on("click", '.edit-modal', function () {
                var idpeternak = $(this).attr('data-id');
                $.ajax({
                    url: "{{url('/cekpeternak')}}/" + idpeternak,
                    type: 'GET',
                    datatype: 'json',
                    success: function (x) {
                        $.each(x, function (index, z) {
                            $('#nik').val(z.nik);
                            $("#nik").prop('disabled', true);
                            $('#id').val(z.idpeternak);
                            $('#nama').val(z.nama);
                            $('#jk').val(z.jeniskelamin);
                            $('#alamat').val(z.alamat);
                            $('#telp').val(z.telp);
                            $('#desa').val(z.iddesa);
                            $('#simpan').text("UPDATE");
                        });
                    }
                });
            });
        });
    </script>
@endpush
