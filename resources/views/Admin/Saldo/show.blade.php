@extends('layouts.master')
@section('title')
    Saldo Awal
@endsection
@push('css')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">

@endpush

@section('content')
        @if (session()->has('statusInput'))
            <div class="row">
              <div class="col-sm-12 alert alert-success alert-dismissible fade show" role="alert">
                  {{session()->get('statusInput')}}
                  <button type="button" class="close" data-dismiss="alert"
                      aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            </div>
          @endif

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
<<<<<<< Updated upstream
            <h1>Data Saldo Awal</h1>
=======
            <h1>Persediaan Kab Badung</h1>
>>>>>>> Stashed changes
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Saldo Awal</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<<<<<<< Updated upstream
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Data Saldo</h3>
                  <div class="card-tools">
                      <a href="/saldoawal/create" class="btn btn-primary btn-icon-split">
                          <span class="icon text-white-50">
                              <i class="fas fa-save"></i>
                          </span>
                          <span class="text">Saldo Awal Baru</span>
                      </a>
                  </div>
              
                <!--isi tombol disini-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Saldo</th>
                    <th>Tanggal Saldo Awal</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>12345678</td>
                      <td>28-07-2021</td>
                      <td>Testing</td>
                      <td>Testing Percobaan</td>
                      <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-warning"><i class="fas fa-edit"></i><a>
                            <button class="btn btn-sm btn-flat btn-danger" onclick="#"><i class="fa fa-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No.</th>
                      <th>Kode Saldo</th>
                      <th>Tanggal Saldo Awal</th>
                      <th>Status</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
=======
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">List Data Saldo</h3>
                    <div class="card-tools">
                        <a href="/saldoawal/create" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">Saldo Baru</span>
                        </a>
                    </div>
                
                  <!--isi tombol disini-->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                      <thead class="text-center">
                          <tr>
                            <th>No.</th>
                            <th>Kode Saldo Awal</th>
                            <th>Tanggal Saldo Awal</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Perangkat 1</td>
                                <td>Periode Januari</td>
                                <td>01-01-2021</td>
                                <td>01-02-2021</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-warning btn-icon-split">
                                      <span class="icon">
                                          <i class="fas fa-edit"></i>
                                      </span>
                                      <span class="text">Edit</span>
                                  </a>
                                </td>
                             
                            </tr>
                          </tbody>
                          <tfoot class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Kode Saldo Awal</th>
                                <th>Tanggal Saldo Awal</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                          </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
>>>>>>> Stashed changes
              </div>
              <!-- /.card -->
  
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
    <!-- /.content -->

          
                    
@endsection
@push('js')
<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

    
                    

    
@endpush