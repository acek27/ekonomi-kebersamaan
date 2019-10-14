@extends('layouts.masterdashboard')
@section('css')
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('isi')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Kelompok Peternak</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
@if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    @endif
<form method="POST" action="{{route('kelompokpeternak.store')}}" role="form">
    @csrf
    <label style="color:black">Nama Kelompok</label>
    <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="emailHelp" placeholder="" required>
    <label style="color:black">Alamat Sekretariat</label>
    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" aria-describedby="emailHelp" placeholder="" required>
    <label style="color:black">Desa</label>
    <select class="form-control show-tick" id="desa" name="iddesa" required>
        <option value="">-- Please select --</option>
        @foreach($desa as $values)
        <option value="{{$values->iddesa}}">{{$values->namadesa}}</option>
        @endforeach
    </select>
    <label style="color:black">Kecamatan</label>
    <select class="form-control show-tick" name="idkecamatan" required>
        <option value="">-- Please select --</option>
        @foreach($kecamatan as $values)
        <option value="{{$values->idkecamatan}}">{{$values->kecamatan}}</option>
        @endforeach
    </select>
    <label style="color:black">Tahun Pembentukan</label>
    <input type="text" class="form-control form-control-user" id="thn" name="thn" aria-describedby="emailHelp" placeholder="" required>
    <!-- <label style="color:black">Ketua Kelompok</label>
    <input type="text" class="form-control form-control-user" id="ketua" name="ketua" aria-describedby="emailHelp" placeholder="Masukkan NIK disini.." required>
    <button type="button" id="tb_nik">Cek NIK</button>
    <br>
    <label style="color:black">Nama Ketua Kelompok</label>
    <input type="text" class="form-control form-control-user" id="namaketua" name="namaketua" aria-describedby="emailHelp" placeholder="" required disabled>
    <label style="color:black">Sekretaris</label>
    <input type="text" class="form-control form-control-user" id="sekretaris" name="sekretaris" aria-describedby="emailHelp" placeholder="Masukkan NIK disini.." required>
    <button type="button" id="tb_nik">Cek NIK</button>
    <br>
    <label style="color:black">Nama Sekretaris Kelompok</label>
    <input type="text" class="form-control form-control-user" id="namasekretaris" name="namasekretaris" aria-describedby="emailHelp" placeholder="" required disabled>
    <label style="color:black">Bendahara Kelompok</label>
    <input type="text" class="form-control form-control-user" id="namabendahara" name="namabendahara" aria-describedby="emailHelp" placeholder="Masukkan NIK disini.." required>
    <button type="button" id="tb_nik">Cek NIK</button>
    <label style="color:black">Nama Bendahara Kelompok</label>
    <input type="text" class="form-control form-control-user" id="namasekretaris" name="namasekretaris" aria-describedby="emailHelp" placeholder="" required disabled>
     -->
    <br>
    <br>
    <button type="submit" id="simpan" style="align-center" class="btn-sm btn-primary shadow-sm">
        SIMPAN</button>

</form>
@csrf
<br>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Kelompok Peternak</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
        <table class="table table-bordered" id="kelompokternak" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kelompok Peternak</th>
                    <th>Alamat</th>
                    <th>Desa</th>
                    <th>Kecamatan</th>
                    <th>Tahun Pembentukan</th>
                    <th>Action</th>

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
    $(document).ready(function() {
        var dt = $('#kelompokternak').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('tabel.kelompokpeternak')}}',
            columns: [{
                    data: 'idkelompokternak',
                    name: 'idkelompokternak'
                },
                {
                    data: 'namakelompokternak',
                    name: 'namakelompokternak'
                },
                {
                    data: 'alamatsekretariat',
                    name: 'alamatsekretariat'
                },
                {
                    data: 'desa',
                    name: 'desa'
                },
                {
                    data: 'namakecamatan',
                    name: 'namakecamatan'
                },
                {
                    data: 'tahunpembentukan',
                    name: 'tahunpembentukan'
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
                        url: "{{route('kelompokpeternak.index')}}/" + id,
                        method: "DELETE",
                    }).done(function (msg) {
                        dt.ajax.reload();
                        $('#nama').val("");
                        $('#alamat').val("");
                        $('#desa').val("");
                        $('#thn').val("");
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
        $('body').on("click", '.edit-modal', function () {
            var idkelompokpeternak = $(this).attr('data-id');
            $.ajax({
                url: "{{url('/cekkelompokpeternak')}}/" + idkelompokpeternak,
                type: 'GET',
                datatype: 'json',
                success: function (x) {
                    $.each(x, function (index, z) {
                        $('#nama').val(z.namakelompokternak);
                        $('#id').val(z.idkelompokternak);
                        $('#alamat').val(z.alamatsekretariat);
                        $('#desa').val(z.iddesa);
                        $('#thn').val(z.tahunpembentukan);
                        $('#simpan').text("UPDATE");
                    });
                }
            });
        });
    });
</script>
@endpush
