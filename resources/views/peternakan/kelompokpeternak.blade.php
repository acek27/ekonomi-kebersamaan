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
    <label style="color:black">Kecamatan</label>
    <select class="form-control show-tick" name="idkecamatan" required>
        <option value="">-- Please select --</option>
        @foreach($kecamatan as $values)
        <option value="{{$values->idkecamatan}}">{{$values->kecamatan}}</option>
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
              <h6 class="m-0 font-weight-bold text-primary">Data Kelompok Peternak</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
        <table class="table table-bordered" id="kelompokternak" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kelompok Peternak</th>
                    <th>Kecamatan</th>
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
                    data: 'namakecamatan',
                    name: 'namakecamatan'
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