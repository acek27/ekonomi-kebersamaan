@extends('layouts.masterdashboard')
@section('isi')
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Data Anggota Kelompok Peternak</h1>
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
    <label style="color:black">NIK</label>
    <input type="text" class="form-control form-control-user" id="nik" name="nik" aria-describedby="emailHelp" placeholder="">
    <label style="color:black">Nama Peternak</label>
    <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="emailHelp" placeholder="" disabled>
    <label style="color:black">Alamat</label>
    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" aria-describedby="emailHelp" placeholder="" disabled>
    <label style="color:black">Desa</label>
    <input type="text" class="form-control form-control-user" id="desa" name="desa" aria-describedby="emailHelp" placeholder="" disabled>
    <label style="color:black">Kecamatan</label>
    <input type="text" class="form-control form-control-user" id="kec" name="kec" aria-describedby="emailHelp" placeholder="" disabled>
    <label style="color:black">Jenis Hewan</label>
    <select class="form-control show-tick" name="idkelompok">
    <option value="">-- Please select --</option>
    @foreach($kelompok as $values)
    <option value="{{$values->idkelompokternak}}">{{$values->namakelompokternak}}</option>
    @endforeach
    </select>
    <label style="color:black">Jumlah Hewan Ternak (Ekor)</label>
    <input type="text" class="form-control form-control-user" id="jumlahhewan" name="jumlahhewan" aria-describedby="emailHelp" placeholder="">
    <label style="color:black">Nama Kelompok</label>
    <select class="form-control show-tick" name="idkelompok">
    <option value="">-- Please select --</option>
    @foreach($kelompok as $values)
    <option value="{{$values->idkelompokternak}}">{{$values->namakelompokternak}}</option>
    @endforeach
    </select>
    <label style="color:black">Jabatan</label>
    <select class="form-control show-tick" name="jabatan">
    <option value="Anggota">Anggota</option>
    <option value="Ketua">Ketua</option>
    <option value="Ketua">Sekretaris</option>
    <option value="Ketua">Bendahara</option>
    </select>
    <label style="color:black">Tanggal Bergabung</label>
    <input type="text" value="{{$date}}" class="form-control form-control-user" id="nama" name="tgl" aria-describedby="emailHelp" disabled>
    
<br>
    <button type="submit" style="align-center" class="btn-sm btn-primary shadow-sm">
     SIMPAN</button>

</form>
   
@endsection