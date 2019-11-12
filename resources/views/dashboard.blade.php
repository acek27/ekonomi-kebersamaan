@extends('layouts.masterdashboard')
@section('isi')
   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
  <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text font-weight-bold text-primary h4 mb-0 font-weight-bold">JADWAL TANAM</div>
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Details</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-black-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
          <div class="text font-weight-bold text-success h4 mb-0 font-weight-bold">JADWAL PANEN</div>
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Details</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-black-300"></i>
           </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
          <div class="text font-weight-bold text-warning h4 mb-0 font-weight-bold">STOK PETERNAKAN</div>
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Details</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-black-300"></i>
            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
          <div class="text font-weight-bold text-info h4 mb-0 font-weight-bold">STOK PERTANIAN</div>
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Details</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-black-300"></i>
            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
          </div>
        </div>
      </div>
    </div>
  </div>
     <div class="col-lg-6 mb-4">
        <div class="card bg-primary text-white shadow">
          <div class="card-body h3">
            Kelompok Peternakan
            <div class="text-white-50 small"> 91 Kelompok </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-success text-white shadow">
          <div class="card-body h3">
            Kelompok Pertanian
            <div class="text-white-50 small"> 739 Kelompok</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-info text-white shadow">
          <div class="card-body h3">
            Kelompok UMKM
            <div class="text-white-50 small"> 716 Kelompok</div>
          </div>
        </div>
      
  </div>
  <!-- Earnings (Monthly) Card Example -->
  <!-- <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
              </div>
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <!-- Pending Requests Card Example -->
  <!-- <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div> --> 
</div>

<!-- Content Row -->
<div class="row">

  

  <div class="col-lg-6 mb-4">
  <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">3 Komoditas Unggulan Pertanian</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Dropdown Header:</div>
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </div>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
          <canvas id="myPieChart"></canvas>
        </div>
        <div class="mt-4 text-center small">
          <span class="mr-2">
            <i class="fas fa-circle text-primary"></i> Padi
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-success"></i> Jagung
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-info"></i> Tebu
          </span>
         </div>
      </div>
    </div>

  </div>


  <!-- Content Column -->
  <div class="col-lg-6 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Populasi Hewan Ternak</h6>
      </div>
      <div class="card-body">
        <h4 class="small font-weight-bold">Ayam <span class="float-right">1.574.322</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-danger" role="progressbar" style="width: 74%" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Sapi <span class="float-right">250.000</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 14%" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Itik <span class="float-right">61.092</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar" role="progressbar" style="width: 4%" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Domba <span class="float-right">54.683</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-info" role="progressbar" style="width: 4%" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Kambing<span class="float-right">41.654</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-success" role="progressbar" style="width: 3%" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Kerbau <span class="float-right">246</span></h4>
        <div class="progress">
          <div class="progress-bar bg-success" role="progressbar" style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>

    

  </div>

</div>


<!-- Content Row -->

<div class="row">

 
  <!-- Pie Chart -->
  <div class="col-xl-4 col-lg-5">
   
  </div>
</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
<div class="container my-auto">
<div class="copyright text-center my-auto">
  <span>Copyright &copy; Your Website 2019</span>
</div>
</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
@endsection()