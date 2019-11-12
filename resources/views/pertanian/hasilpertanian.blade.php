@extends('layouts.masterdashboard')
@section('css')
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/css/gijgo.min.css">
@endsection
@section('isi')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Hasil Pertanian</h1>
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
        <form method="POST" action="{{route('hasilpertanian.store')}}" role="form">
          @csrf
          <label style="color:black">Nama Petani : {{$value->nama}} </label> <br>
          <label style="color:black">Lokasi Lahan : {{$value->namadesa}} </label> <br>
          <label style="color:black">Kelompok : {{$value->namakelompok}} </label> <br>
          <br>
          <label style="color:black">Jenis Tanaman</label>
          <select class="form-control show-tick" name="idjenis" required>
            <option value="">-- Please select --</option>
            @foreach($jenis as $values)
            <option value="{{$values->idjenis}}">{{$values->jenistanaman}}</option>
            @endforeach
          </select>
          <label style="color:black">Hasil Produksi (Kg)</label>
          <input type="text" class="form-control form-control-user" id="hasil" name="hasil" 
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
        <h6 class="m-0 font-weight-bold text-primary">HASIL PENJUALAN</h6>
      </div>
      <div class="card-body">
        <!-- <div class="row"> -->
        <form method="POST" action="{{route('hasilpertanian.store')}}" role="form">
          @csrf
          <label style="color:black">Jenis Tanaman</label>
          <select class="form-control show-tick" name="idjenis" required>
            <option value="">-- Please select --</option>
            @foreach($jenis as $values)
            <option value="{{$values->idjenis}}">{{$values->jenistanaman}}</option>
            @endforeach
          </select> <br>
          <label style="color:black">Stok Saat Ini</label> <br>
          <h1 style="font-size: 40pt"> {{ 0 }} kg</h1>
          <label style="color:black">Terjual</label>
          <input type="text" class="form-control form-control-user" id="terjual" name="terjual" aria-describedby="emailHelp" placeholder="" required>
          <br>
          <button type="submit" style="align-center" class="btn-sm btn-primary shadow-sm">
            SIMPAN</button>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection

@push('script')
    <script href="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/js/gijgo.min.js"></script>
<script>
$(function () {
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
            });
        });
    </script>
@endpush
