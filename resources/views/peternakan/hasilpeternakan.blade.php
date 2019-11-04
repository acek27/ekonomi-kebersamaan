@extends('layouts.masterdashboard')
@section('css')
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{url('https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/css/gijgo.min.css')}}" rel="stylesheet"/>
@endsection
@section('isi')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Hasil Peternakan</h1>
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
        @foreach($data as $value)
        <form method="POST" action="{{route('hasilpeternakan.store')}}" role="form">
          @csrf
          <label style="color:black">Nama Peternak : {{$value->nama}} </label> <br>
          <label style="color:black">Lokasi Peternakan : {{$value->namadesa}} </label> <br>
          <label style="color:black">Jenis Ternak : {{$value->jenisternak}} </label> <br>
          <label style="color:black">Kelompok : {{$value->namakelompokternak}} </label> <br>
          <br>
          <label style="color:black">Hasil Produksi</label>
          <select class="form-control show-tick" name="idjenis" required>
            <option value="">-- Please select --</option>
            <option value="kohe">KOHE</option>
            <option value="urie">URINE</option>
            <option value="bokasi">BOKASI</option>
          </select>
          <label style="color:black">Jumlah Produksi </label>
          <input type="text" class="form-control form-control-user" id="hasilbokasi" name="hasilbokasi"
          aria-describedby="emailHelp" placeholder="" required>
          <input type="text" class="form-control form-control-user" id="idkeanggotaan"
          name="idkeanggotaan" aria-describedby="emailHelp" value="{{$value->idkeanggotaan}}" hidden>
          <label style="color:black">Tanggal Update</label>
          <input type="text" class="form-control datepicker" id="datepicker" name="tgl"
               aria-describedby="emailHelp" required>
          <br>
          <button type="submit" style="align-center" class="btn-sm btn-primary shadow-sm">
            SIMPAN</button>
          @endforeach
        </form>
      </div>
    </div>
  </div>


  <!-- Content Column Ke 2-->
  <div class="col-lg-6 mb-4">
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Hasil Penjualan</h6>
      </div>
      <div class="card-body">
        <!-- <div class="row"> -->
        <form method="POST" action="{{route('hasilpeternakan.store')}}" role="form">
          @csrf
          <label style="color:black">Hasil Produksi</label>
          <select class="form-control show-tick" name="idjenis" required>
            <option value="">-- Please select --</option>
            <option value="kohe">KOHE</option>
            <option value="urie">URINE</option>
            <option value="bokasi">BOKASI</option>
          </select> <br>
          <label style="color:black">Stok Saat Ini</label> <br>
          <h1 style="font-size: 40pt"> {{ 0 }} kg</h1>
          <label style="color:black">Penjualan</label>
          <input type="text" class="form-control form-control-user" id="terjual" name="terjual" aria-describedby="emailHelp" placeholder="" required>
          <br>
          <button type="submit" class="btn-sm btn-primary shadow-sm">
            SIMPAN</button>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection

@push('script')
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/js/gijgo.min.js')}}"></script>
<script>
$(function () {
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
            });
        });
    </script>
@endpush
