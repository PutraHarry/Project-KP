@extends('layouts.master')
@section('title')
    Penerimaan
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
            <h1>Persediaan Kab Badung</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Penerimaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">List Data Penerimaan</h3>
                    <div class="card-tools">
                        <a href="/penerimaan/create" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">Penerimaan Baru</span>
                        </a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 my-1">
                            <ul class="nav nav-pills d-flex justify-content-center justify-content-md-start">
                                <li class="nav-item"><a class="nav-link active" href="#tbobat" data-toggle="tab">Obat</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tbnon-obat" data-toggle="tab">Non Obat</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tbhibah" data-toggle="tab">Hibah</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tbnon-hibah" data-toggle="tab">Non Hibah</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tbnon-apbd" data-toggle="tab">Non APBD</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive-md">
                  <div class="tab-content">
                    <div class="active tab-pane" id="tbobat">
                        <table id="dataObat" class="table table-responsive-md table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                  <th>No.</th>
                                  <th>Penerimaan</th>
                                  <th>Tanggal Penerimaan</th>
                                  <th>Status</th>
                                  <th>Keterangan</th>
                                  <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr class="text-center">
                                  <td>1</td>
                                  <td>Penerimaan Obat</td>
                                  <td>01-01-2021</td>
                                  <td>testing</td>
                                  <td>Keterangan testing</td>
                                  <td>
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
                                  <th>Penerimaan</th>
                                  <th>Tanggal Penerimaan</th>
                                  <th>Status</th>
                                  <th>Keterangan</th>
                                  <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="active tab-pane" id="tbnon-obat">
                        <table id="dataNonObat" class="table table-responsive-md table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                  <th>No.</th>
                                  <th>Penerimaan Non Obat</th>
                                  <th>Tanggal Penerimaan</th>
                                  <th>Status</th>
                                  <th>Keterangan</th>
                                  <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr class="text-center">
                                  <td>1</td>
                                  <td>Penerimaan Non Obat</td>
                                  <td>01-01-2021</td>
                                  <td>testing</td>
                                  <td>Keterangan testing</td>
                                  <td>
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
                                  <th>Penerimaan</th>
                                  <th>Tanggal Penerimaan Non Obat</th>
                                  <th>Status</th>
                                  <th>Keterangan</th>
                                  <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="active tab-pane" id="tbhibah">
                        <table id="dataHibah" class="table table-responsive-md table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                  <th>No.</th>
                                  <th>Penerimaan Hibah</th>
                                  <th>Tanggal Penerimaan</th>
                                  <th>Status</th>
                                  <th>Keterangan</th>
                                  <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr class="text-center">
                                  <td>1</td>
                                  <td>Penerimaan Obat</td>
                                  <td>01-01-2021</td>
                                  <td>testing</td>
                                  <td>Keterangan testing</td>
                                  <td>
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
                                  <th>Penerimaan</th>
                                  <th>Tanggal Penerimaan Hibah</th>
                                  <th>Status</th>
                                  <th>Keterangan</th>
                                  <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="active tab-pane" id="tbnon-hibah">
                        <table id="dataNonHibah" class="table table-responsive-md table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                  <th>No.</th>
                                  <th>Penerimaan Non Hibah</th>
                                  <th>Tanggal Penerimaan</th>
                                  <th>Status</th>
                                  <th>Keterangan</th>
                                  <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr class="text-center">
                                  <td>1</td>
                                  <td>Penerimaan Non Hibah</td>
                                  <td>01-01-2021</td>
                                  <td>testing</td>
                                  <td>Keterangan testing</td>
                                  <td>
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
                                  <th>Penerimaan Non Hibah</th>
                                  <th>Tanggal Penerimaan</th>
                                  <th>Status</th>
                                  <th>Keterangan</th>
                                  <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="active tab-pane" id="tbnon-apbd">
                        <table id="dataNonAPBD" class="table table-responsive-md table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                  <th>No.</th>
                                  <th>Penerimaan Non APBD</th>
                                  <th>Tanggal Penerimaan</th>
                                  <th>Status</th>
                                  <th>Keterangan</th>
                                  <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr class="text-center">
                                  <td>1</td>
                                  <td>Penerimaan Non APBD</td>
                                  <td>01-01-2021</td>
                                  <td>testing</td>
                                  <td>Keterangan testing</td>
                                  <td>
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
                                  <th>Penerimaan Non APBD</th>
                                  <th>Tanggal Penerimaan</th>
                                  <th>Status</th>
                                  <th>Keterangan</th>
                                  <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
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