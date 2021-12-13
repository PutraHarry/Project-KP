@extends('layouts.master')
@section('title') Laporan @endsection
    
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Persediaan Kab Badung</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
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
          <!-- /.card -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Pelaporan Data Persediaan
                </h3>
            </div>
            <div class="card-body">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                        <h4>Laporan Persediaan</h4>
                            <div class="text">
                                <p>Per-kegiatan Untuk Periode Aktif</p>
                            </div>
                        </div>
                        
                        <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/laporan/laporan-persediaan" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                            <h4>Laporan Persediaan</h4>
                                <div class="text">
                                    <p>Per-kegiatan</p>
                                </div>
                            </div>
                            <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="/laporan/laporan-persediaan" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                            <h4>Laporan Persediaan</h4>
                                <div class="text">
                                    <p>Dinas</p>
                                </div>
                            </div>
                            <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="/laporan/laporan-persediaan-opd" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                            <h4>Laporan Persediaan</h4>
                                <div class="text">
                                    <p>Per Bidang/Unit Kerja</p>
                                </div>
                            </div>
                            <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="/laporan/laporan-persediaan" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                            <h4>Laporan Rekap Persediaan</h4>
                                
                            </div>
                            <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="/laporan/laporan-persediaan" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                        <h4>Kartu Barang</h4>
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
                    <div class="small-box bg-info">
                        <div class="inner">
                        <h4>Kartu Persediaan Barang</h4>
                        </div>
                        <div class="icon">
                        <i class="ion ion-android-menu"></i>
                        </div>
                        <a href="/penerimaan" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                        <div class="inner">
                            <h4>Buku Penerimaan Barang</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-paper"></i>
                        </div>
                        <a href="/penggunaan" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                        <div class="inner">
                            <h4>Laporan Pengeluaran Barang</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/laporan/laporan-pengeluaran" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                        <div class="inner">
                            <h4>Bukti Pengambilan Barang</h4>   
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-paper"></i>
                        </div>
                        <a href="#" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                            <h4>Laporan Opname</h4>
                            </div>
                            <div class="icon">
                            <i class="ion ion-android-menu"></i>
                            </div>
                            <a href="/laporan/L_opname" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        </div>
                </div>
            </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection