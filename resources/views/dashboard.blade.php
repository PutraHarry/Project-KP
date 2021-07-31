@extends('layouts.master')
@section('title') Dashboard @endsection
    
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- solid sales graph -->
        <div class="card bg-gradient-default">
            <div class="card-header border-0">
              <h3 class="card-title">
                <i class="fas fa-th mr-1"></i>
                Sistem Persediaan BPKAD Badung
              </h3>

              <div class="card-tools">
                <button type="button" class="btn bg-default btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <center>
                <img src="/adminlte/dist/img/logo_pemkab.jpg" alt="Logo Pemkab Badung" style="width:100px; height:100px;">
                <p>Sistem yang dibangun untuk melakukan pengelolaan data persediaan di Badan Pengelolaan Keuangan dan Aset Daerah Kabupaten Badung</p>
              </center>
            </div>
            
          </div>
          <!-- /.card -->
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Periode</h3>

                <p>Pengelolaan Data Periode</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="/periode" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Saldo Awal</h3>

                <p>Pengelolaan Data Saldo</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-menu"></i>
              </div>
              <a href="/saldoawal" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Penerimaan</h3>

                <p>Pengelolaan Data Penerimaan</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Penggunaan</h3>

                <p>Pengelolaan Data Penggunaan</p>
              </div>
              <div class="icon">
                <i class="ion ion-network"></i>
              </div>
              <a href="#" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>Pengeluaran</h3>
  
                  <p>Pengelolaan Data Pengeluaran</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-paper"></i>
                </div>
                <a href="#" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>Opname</h3>
  
                  <p>Pengelolaan Data Opname</p>
                </div>
                <div class="icon">
                  <i class="ion ion-social-dropbox"></i>
                </div>
                <a href="#" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>Pemusnahan</h3>
  
                  <p>Pengelolaan Data Pemusnahan</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-flame"></i>
                </div>
                <a href="#" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>Bukti Umum</h3>
  
                  <p>Pengelolaan Data Bukti Umum</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-document"></i>
                </div>
                <a href="/buktiumum" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection