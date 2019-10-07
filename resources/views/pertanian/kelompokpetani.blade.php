@extends('layouts.masterdashboard')
@section('css')
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('isi')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Kelompok Tani</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
@if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    @endif
<form method="POST" action="{{route('kelompokpetani.store')}}" role="form">
    @csrf
    <label style="color:black">Nama Kelompok</label>
    <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="emailHelp" placeholder="" required>
    <label style="color:black">Alamat</label>
    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" aria-describedby="emailHelp" placeholder="" required>
    <label style="color:black">Desa</label>
    <select class="form-control show-tick" name="iddesa" required>
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
    <label style="color:black">Jenis Kelompok</label>
    <select class="form-control show-tick" name="jeniskelompok" required>
        <option value="">-- Please select --</option>
        @foreach($jenis as $values)
        <option value="{{$values->jeniskelompok}}">{{$values->jeniskelompok}}</option>
        @endforeach
    </select>
        <br>
    <button type="submit" style="align-center" class="btn-sm btn-primary shadow-sm">
        SIMPAN</button>

</form>
@csrf
<br>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Kelompok Petani</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
        <table class="table table-bordered" id="kelompoktani" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kelompok Peternak</th>
                    <th>AlamatSekretariat</th>
                    <th>Desa</th>
                    <th>Kecamatan</th>
                    <th>Tahun Pembentukan</th>
                    <th>Jenis Kelompok</th>
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
        var dt = $('#kelompoktani').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('tabel.kelompokpetani')}}',
            columns: [{
                    data: 'idkelompok',
                    name: 'idkelompok'
                },
                {
                    data: 'namakelompok',
                    name: 'namakelompok'
                },
                {
                    data: 'alamatsekretariat',
                    name: 'alamatsekretariat'
                },
                {
                    data: 'desa',
                    name: 'adesa'
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
                    data: 'jeniskelompok',
                    name: 'jeniskelompok'
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
</script>
@endpush