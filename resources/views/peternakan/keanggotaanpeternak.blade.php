@extends('layouts.masterdashboard')
@section('css')
    <link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
@endsection
@section('isi')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Anggota Kelompok Peternak</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    @endif
    <form method="POST" action="{{route('keanggotaanpeternak.store')}}" role="form">
        @csrf
        <label style="color:black">NIK</label>
        <input type="text" class="form-control form-control-user" id="nik" name="nik" aria-describedby="emailHelp"
               placeholder="">
        <label style="color:black">Nama Peternak</label>
        <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="emailHelp"
               placeholder="" disabled>
        <label style="color:black">Alamat</label>
        <input type="text" class="form-control form-control-user" id="alamat" name="alamat" aria-describedby="emailHelp"
               placeholder="" disabled>
        <label style="color:black">Jenis Ternak Yang Dimiliki</label>
        <select class="form-control show-tick" name="idjenis">
            <option value="">-- Please select --</option>
            @foreach($jenisternak as $values)
                <option value="{{$values->idjenis}}">{{$values->jenisternak}}</option>
            @endforeach
        </select>
        <label style="color:black">Jumlah Ternak (Ekor)</label>
        <input type="text" class="form-control form-control-user" id="jumlah" name="jumlah" aria-describedby="emailHelp"
               placeholder="">

        <br><label style="color:black">LOKASI TERNAK:</label>
        <br>
        <label style="color:black">Desa</label>
        <select class="form-control show-tick" name="iddesa">
            <option value="">-- Please select --</option>
            @foreach($desa as $values)
                <option value="{{$values->iddesa}}">{{$values->namadesa}}</option>
            @endforeach
        </select>

        <label style="color:black">Nama Kelompok</label>
        <select class="form-control show-tick" name="idkelompok">
            <option value="">-- Please select --</option>
            @foreach($kelompok as $values)
                <option value="{{$values->idkelompokternak}}">{{$values->namakelompokternak}}</option>
            @endforeach
        </select>
        <label style="color:black">Jabatan</label>
        <select class="form-control show-tick" name="jabatan">
            <option value="anggota">Anggota</option>
            <option value="ketua">Ketua</option>
            <option value="sekretaris">Sekretaris</option>
            <option value="bendahara">Bendahara</option>
        </select><label style="color:black">Tanggal Bergabung</label>
        <input type="text" class="form-control datepicker" id="datepicker" name="tgl"
               aria-describedby="emailHelp" required>
        <input type="text" class="form-control form-control-user" id="idpeternak" name="idpeternak"
               aria-describedby="emailHelp" placeholder="" hidden>
        <br>
        <button type="submit" class="btn-sm btn-primary shadow-sm">
            SIMPAN
        </button>

    </form>
    <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Keanggotaan Peternak</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="text-align: center" id="datapokter"
                       class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th style="width: 7%;text-align: center; vertical-align: middle">NIK</th>
                        <th style="text-align: center; vertical-align: middle">Nama</th>
                        <th style="text-align: center; vertical-align: middle">Alamat</th>
                        <th style="text-align: center; vertical-align: middle">Jenis Ternak</th>
                        <th style="text-align: center; vertical-align: middle">Jumlah Ternak (Ekor)</th>
                        <th style="text-align: center; vertical-align: middle">Lokasi Ternak</th>
                        <th style="text-align: center; vertical-align: middle">Kelompok</th>
                        <th style="text-align: center; vertical-align: middle">Jabatan</th>
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
    <script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/dist/js/standalone/selectize.js')}}"></script>
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('asetsba2/js/demo/datatables-demo.js')}}"></script>

    <script>
        $(document).ready(function () {
            var dt = $('#datapokter').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('tabel.pokter')}}',
                columns: [{
                    data: 'nik',
                    name: 'nik'
                },
                    {
                        data: 'namapeternak',
                        name: 'namapeternak'
                    },
                    {
                        data: 'namadesa',
                        name: 'namadesa'
                    },
                    {
                        data: 'jenisternak',
                        name: 'jenisternak'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'namakelompok',
                        name: 'namakelompok'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'tglbergabung',
                        name: 'tglbergabung'
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
                            url: "{{route('keanggotaanpeternak.index')}}/" + id,
                            method: "DELETE",
                        }).done(function (msg) {
                            dt.ajax.reload();
                            $('#nama').val("");
                            $('#id').val("");
                            $('#idkategori').val("");
                            $('#simpan').text("SIMPAN");
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
        });


        $(function () {
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
            });
        });
        $('#nik').change(function () {
            var kode = $("#nik").val();

            $.ajax({
                url: "{{url('/ceknik')}}/" + kode,
                type: 'GET',
                datatype: 'json',
                success: function (x) {
                    $.each(x, function (index, z) {
                        $('#idpeternak').val(z.idpeternak);
                        $('#nama').val(z.nama);
                        $('#alamat').val(z.alamat);
                        $('#desa').val(z.namadesa);
                        $('#kec').val(z.kecamatan);
                    });
                }
            });
        });
    </script>
@endpush
