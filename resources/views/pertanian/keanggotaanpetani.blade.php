@extends('layouts.masterdashboard')
@section('isi')
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Data Anggota Kelompok Tani</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    @endif
<form method="POST" action="{{route('keanggotaanpetani.store')}}" role="form">
    @csrf
    <label style="color:black">NIK</label>
    <input type="text" class="form-control form-control-user" id="nik" name="nik" aria-describedby="emailHelp" placeholder="">
    <label style="color:black">Nama Petani</label>
    <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="emailHelp" placeholder="" disabled>
    <label style="color:black">Alamat</label>
    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" aria-describedby="emailHelp" placeholder="" disabled>
    <label style="color:black">Lahan yang dimiliki (Ha)</label>
    <input type="text" class="form-control form-control-user" id="lahan" name="lahan" aria-describedby="emailHelp" placeholder="">
    <label style="color:black">LOKASI LAHAN:</label>
    <br>
    <label style="color:black">Desa</label>
    <select class="form-control show-tick" name="idkelompok">
    <option value="">-- Please select --</option>
    @foreach($desa as $values)
    <option value="{{$values->iddesa}}">{{$values->namadesa}}</option>
    @endforeach
    </select>
    <label style="color:black">Kecamatan</label>
    <select class="form-control show-tick" name="idkelompok">
    <option value="">-- Please select --</option>
    @foreach($kecamatan as $values)
    <option value="{{$values->idkecamatan}}">{{$values->kecamatan}}</option>
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
    <input type="text" value="{{$date}}" class="form-control form-control-user" id="nama" name="tgl" aria-describedby="emailHelp" disabled>
    
   
<br>
    <button type="submit" style="align-center" class="btn-sm btn-primary shadow-sm">
     SIMPAN</button>

</form>
   
@endsection