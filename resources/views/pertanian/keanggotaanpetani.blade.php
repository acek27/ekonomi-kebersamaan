@extends('layouts.masterdashboard')
@section('css')
    <link href="{{url('https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/css/gijgo.min.css')}}"
          rel="stylesheet"/>
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('isi')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Anggota Kelompok Tani</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    @endif
    <form method="POST" action="{{route('keanggotaanpetani.store')}}" role="form">
        @csrf
        <div class="row">
  <!-- Content Column Ke 1-->
  <div class="col-lg-6 mb-4">
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DAFTAR KEANGGOTAAN PETANI</h6>
      </div>
      <div class="card-body">
        <label style="color:black">NIK</label>
        <input type="text" class="form-control form-control-user" id="nik" name="nik" aria-describedby="emailHelp"
               placeholder="">
        <label style="color:black">Nama Petani</label>
        <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="emailHelp"
               placeholder="" disabled>
        <label style="color:black">Alamat</label>
        <input type="text" class="form-control form-control-user" id="alamat" name="alamat" aria-describedby="emailHelp"
               placeholder="" disabled>
        <label style="color:black">Lahan yang dimiliki (Ha)</label>
        <input type="text" class="form-control form-control-user" id="lahan" name="lahan" aria-describedby="emailHelp"
               placeholder="">
        <label style="color:black">LOKASI LAHAN:</label>
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
                <option value="{{$values->idkelompok}}">{{$values->namakelompok}}</option>
            @endforeach
        </select>
        <label style="color:black">Jabatan</label>
        <select class="form-control show-tick" name="jabatan">
            <option value="anggota">Anggota</option>
            <option value="ketua">Ketua</option>
            <option value="sekretaris">Sekretaris</option>
            <option value="bendahara">Bendahara</option>
        </select><label style="color:black">Tanggal Bergabung</label>
        <input type="text" class="form-control form-control-user datepicker" id="datepicker" name="tgl"
               aria-describedby="emailHelp" required>
        <input type="text" class="form-control form-control-user" id="idpetani" name="idpetani"
               aria-describedby="emailHelp" placeholder="" hidden>
        <br>
        <button type="submit" class="btn-sm btn-primary shadow-sm">
            SIMPAN
        </button>
    </form>
    </div>
        </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block bg-pertanian"></div>
</div>
    <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Keanggotaan Peternak</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="text-align: center" id="datapoktan"
                       class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th style="width: 7%;text-align: center; vertical-align: middle">NIK</th>
                        <th style="text-align: center; vertical-align: middle">Nama</th>
                        <th style="text-align: center; vertical-align: middle">Alamat</th>
                        <th style="text-align: center; vertical-align: middle">Lahan Garapan (Ha)</th>
                        <th style="text-align: center; vertical-align: middle">Lokasi Lahan</th>
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
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('asetsba2/js/demo/datatables-demo.js')}}"></script>
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/js/gijgo.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            var dt = $('#datapoktan').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('tabel.poktan')}}',
                columns: [{
                    data: 'nik',
                    name: 'nik'
                },
                    {
                        data: 'namapetani',
                        name: 'namapetani'
                    },
                    {
                        data: 'namadesa',
                        name: 'namadesa'
                    },
                    {
                        data: 'luaslahan',
                        name: 'luaslahan'
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
                url: "{{url('/cekniktani')}}/" + kode,
                type: 'GET',
                datatype: 'json',
                error: function (x, exception) {
                    swal("Gagal", "Data Tidak Ditemukan", "error");
                    $('#nama').val("");
                    $('#alamat').val("");
                },
                success: function (x) {
                    $.each(x, function (index, z) {
                        $('#nama').val(z.nama);
                        $('#alamat').val(z.alamat);
                        $('#idpetani').val(z.idpetani);

                    });
                }
            });
        });
    </script>
@endpush
