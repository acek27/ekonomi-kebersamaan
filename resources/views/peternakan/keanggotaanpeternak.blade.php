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
    <form method="POST" action="{{route('dataternak.store')}}" role="form">
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
        <label style="color:black">Desa</label>
        <input type="text" class="form-control form-control-user" id="desa" name="desa" aria-describedby="emailHelp"
               placeholder="" disabled>
        <label style="color:black">Kecamatan</label>
        <input type="text" class="form-control form-control-user" id="kec" name="kec" aria-describedby="emailHelp"
               placeholder="" disabled>
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
        </select>
        <label style="color:black">Tanggal Bergabung</label>
        <input type="text" class="form-control datepicker" id="datepicker" name="tgl"
               aria-describedby="emailHelp" required>

        <br>
        <button type="submit" class="btn-sm btn-primary shadow-sm">
            SIMPAN
        </button>

    </form>

@endsection

@push('script')
    <script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/dist/js/standalone/selectize.js')}}"></script>

    <script>
        $(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
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
