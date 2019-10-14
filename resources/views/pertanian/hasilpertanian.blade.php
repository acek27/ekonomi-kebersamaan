@extends('layouts.masterdashboard')
@section('css')
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('isi')

<form method="POST" action="{{route('hasilpertanian.store')}}" role="form">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Hasil Pertanian Organik</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<div class="row">
            <!-- Content Column Ke 1-->
            <div class="col-lg-6 mb-4">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">HASIL PRODUKSI</h6>
                </div>
                <div class="card-body">
<!-- <div class="row"> -->
@if (session()->has('flash_notification.message'))
<div class="alert alert-{{ session()->get('flash_notification.level') }}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! session()->get('flash_notification.message') !!}
</div>
@endif

    @csrf
    <input type="text" class="form-control form-control-user" id="id" name="id" aria-describedby="emailHelp" placeholder="" required>
    <label style="color:black">NIK</label>
    <input type="text" class="form-control form-control-user" id="nik" name="nik" aria-describedby="emailHelp" placeholder="" required>
    <label style="color:black">Nama Petani</label>
    <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="emailHelp" placeholder="" required>
    <label style="color:black">LOKASI LAHAN:</label> <br>
    <label style="color:black">Desa</label>
    <input type="text" class="form-control form-control-user" id="lokasi" name="lokasi" aria-describedby="emailHelp" placeholder="" required>
    <label style="color:black">Hasil Produksi Padi Organik (Kg)</label>
    <input type="text" class="form-control form-control-user" id="hasil" name="hasil" aria-describedby="emailHelp" placeholder="" required>
    <br>
    <button type="submit" style="align-center" class="btn-sm btn-primary shadow-sm">
        SIMPAN</button>
</div>
</div>
</div>
</form>

<form method="POST" action="{{route('hasilpertanian.store')}}" role="form">
<div class="row">
    <!-- Content Column Ke 2-->
            <div class="col-lg-6 mb-4">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">STOK BARANG</h6>
                </div>
                <div class="card-body">
<!-- <div class="row"> -->
@if (session()->has('flash_notification.message'))
<div class="alert alert-{{ session()->get('flash_notification.level') }}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! session()->get('flash_notification.message') !!}
</div>
@endif

    @csrf
    <label style="color:black">Stok Saat Ini</label> <br>
    <h1 style="font-size: 40pt"> {{ 0 }}  kg</h1>
    <label style="color:black">Terjual</label>
    <input type="text" class="form-control form-control-user" id="terjual" name="terjual" aria-describedby="emailHelp" placeholder="" required>
    <br>
    <button type="submit" style="align-center" class="btn-sm btn-primary shadow-sm">
        SIMPAN</button>

</div>
</div>
</div>
</div>
</form>

@endsection
