@extends('layouts.masterdashboard')
@section('isi')
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Data Kepemilikan Lahan Pertanian</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    @endif
<form method="POST" action="{{route('dataternak.store')}}" role="form">
    @csrf
    <label style="color:black">ID Petani</label>
    <input type="text" class="form-control form-control-user" id="nik" name="nik" aria-describedby="emailHelp" placeholder="">
    <label style="color:black">Nama Petani</label>
    <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="emailHelp" placeholder="" disabled>
    <label style="color:black">Alamat</label>
    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" aria-describedby="emailHelp" placeholder="" disabled>
    <label style="color:black">Nama Kelompok</label>
    <input type="text" class="form-control form-control-user" id="kelompok" name="kelompok" aria-describedby="emailHelp" placeholder="" disabled>
    <select class="form-control show-tick" name="idkelompok">
    <label style="color:black">Lahan yang dimiliki (Ha)</label>
    <input type="text" class="form-control form-control-user" id="lahan" name="lahan" aria-describedby="emailHelp" placeholder="" disabled>
    
<br>
    <button type="submit" style="align-center" class="btn-sm btn-primary shadow-sm">
     SIMPAN</button>

</form>
   
@endsection