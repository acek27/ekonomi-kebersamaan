@extends('layouts.masterdashboard')
@section('css')
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('isi')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Petani</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
@if (session()->has('flash_notification.message'))
<div class="alert alert-{{ session()->get('flash_notification.level') }}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! session()->get('flash_notification.message') !!}
</div>
@endif
<form method="POST" action="{{route('datapetani.store')}}" role="form">
    @csrf
    <label style="color:black">NIK</label>
    <input type="text" class="form-control form-control-user" id="nik" name="nik" aria-describedby="emailHelp" placeholder="" required>
    <label style="color:black">Nama Petani</label>
    <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="emailHelp" placeholder="" required>
    <label style="color:black">Jenis Kelamin</label>
    <select class="form-control show-tick" name="iddesa" required>
        <option value="">-- Please select --</option>
        <option value="Laki-Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>
    <label style="color:black">Alamat</label>
    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" aria-describedby="emailHelp" placeholder="" required>
    <label style="color:black">Kecamatan</label>
    <select class="form-control show-tick" id="idkecamatan" name="idkecamatan" required>
        <option value="">-- Please select --</option>
        @foreach($kecamatan as $values)
        <option value="{{$values->idkecamatan}}">{{$values->kecamatan}}</option>
        @endforeach
    </select>
    <label style="color:black">Desa</label>
    <select class="form-control show-tick" id='iddesa' name="iddesa" required>
        <option value="">-- Please select --</option>

    </select>
    <label style="color:black">No Telp</label>
    <input type="text" class="form-control form-control-user" id="telp" name="telp" aria-describedby="emailHelp" placeholder="" required>


    <br>
    <button type="submit" style="align-center" class="btn-sm btn-primary shadow-sm">
        SIMPAN</button>

</form>
<br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Petani</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table style="text-align: center" id="datapetani" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 7%;text-align: center; vertical-align: middle">ID</th>
                        <th style="width: 20%; text-align: left; vertical-align: middle">NIK</th>
                        <th style="text-align: center; vertical-align: middle">Nama</th>
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
    $(document).ready(function() {
        var dt = $('#datapetani').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('tabel.petani')}}',
            columns: [{
                    data: 'idpetani',
                    name: 'idpetani'
                },
                {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'namadesa',
                    name: 'namadesa'
                },
                {
                    data: 'namakecamatan',
                    name: 'namakecamatan'
                },
                {
                    data: 'telp',
                    name: 'telp'
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

    $(document).ready(function() {

        $('#idkecamatan').change(function() {
            //  var id=$(this).val();
            var id = $("#idkecamatan").val();
            $.ajax({
                url: "{{url('/getdesa')}}/" + id,
                method : "POST",
                data: {id: id},
                async: true,
                datatype: 'json',
                success: function(desa) {
                    var i;
                    var html;
                    //  $.each(x, function(index,z {
                    for (i = 0; i < desa.length; i++) {
                        html += <option value = "">'+desa[i].namadesa+'</option>;
                    }
                    $('#iddesa').val(html);
                }
            });
            return false;
        });
    });
</script>
@endpush