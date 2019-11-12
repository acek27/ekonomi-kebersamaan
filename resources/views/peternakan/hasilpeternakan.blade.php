@extends('layouts.masterdashboard')
@section('css')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{url('https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/css/gijgo.min.css')}}"
          rel="stylesheet"/>
@endsection
@section('isi')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Hasil Peternakan</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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
                            <table>

                                <td style="color:black; width:200px">Nama Peternak</td>
                                <th style="color:black">: {{$value->nama}} </th>
                                <tr></tr>
                                <td style="color:black; width:200px">Lokasi Peternak</td>
                                <th style="color:black">: {{$value->namadesa}}</th>
                                <tr></tr>
                                <td style="color:black; width:200px">Jenis Ternak</td>
                                <th style="color:black">: {{$value->jenisternak}}</th>
                                <tr></tr>
                                <td style="color:black; width:200px">Kelompok</td>
                                <th style="color:black">: {{$value->namakelompok}}</th>


                            </table>
                            <br>
                            <label style="color:black">Hasil Produksi</label>
                            <div class="row col-lg-10">
                                <select class="form-control show-tick col-lg-8" name="idjenis" required>
                                    <option value="">-- Please select --</option>
                                    @foreach($produk as $isi)
                                        <option value="{{$isi->id_produk}}">{{$isi->produk}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label style="color:black">Jumlah Produksi </label>
                            <input type="text" class="form-control form-control-user" id="hasilbokasi"
                                   name="jumlah"
                                   aria-describedby="emailHelp" placeholder="" required>
                            <input type="text" class="form-control form-control-user" id="idkeanggotaan"
                                   name="idkeanggotaan" aria-describedby="emailHelp" value="{{$value->idkeanggotaan}}"
                                   hidden>
                            <label style="color:black">Tanggal Update</label>
                            <input type="text" class="form-control datepicker" id="datepicker" name="tgl"
                                   aria-describedby="emailHelp" required>
                            <br>
                            <button type="submit" class="btn-sm btn-primary shadow-sm">
                                SIMPAN
                            </button>
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
                        <select class="form-control show-tick" id="showhasil" name="idjenis" required>
                            <option value="">-- Please select --</option>
                            @foreach($produk as $value)
                                <option value="{{$value->id_produk}}">{{$value->produk}}</option>
                            @endforeach
                        </select> <br>
                        <label style="color:black">Stok Saat Ini</label> <br>
                        <h1 id="nilaihasil" style="font-size: 40pt">0 Kg</h1>
                        <label style="color:black">Penjualan</label>
                        <input type="text" class="form-control form-control-user" id="terjual" name="terjual"
                               aria-describedby="emailHelp" placeholder="" required>
                        <br>
                        <button type="submit" class="btn-sm btn-primary shadow-sm">
                            SIMPAN
                        </button>
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
                format: 'yyyy-mm-dd',
                autoclose: true,
            });
        });

        $('#showhasil').change(function () {
            var kode = $("#showhasil").val();
            $.ajax({
                url: "{{url('/cekhasil')}}/" + kode + "/{{$no}}",
                type: 'GET',
                datatype: 'json',
                error: function (x, exception) {
                    $('#nilaihasil').text("0 Kg");
                },
                success: function (x) {
                    $.each(x, function (index, z) {
                        $('#nilaihasil').text(z.total +" Kg");
                    });
                }
            });
        });
    </script>
@endpush
