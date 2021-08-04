@extends('layouts.master')
@section('title')
    Pengeluaran
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
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Pengeluaran</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">List Data Pengeluaran</h3>
                    <div class="card-tools">
                        <a href="/pengeluaran/create" class="btn btn-primary btn-icon-split">
                            <span class="icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Buat Baru</span>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                      <thead>
                          <tr class="text-center">
                            <th>No.</th>
                            <th>Kode Pengeluaran</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>123-456-789</td>
                            <td>01-01-2021</td>
                            <td>Final</td>
                            <td>Keterangan testing</td>
                            <td class="text-center">
                                <a href="/pengeluaran/edit/" class="btn btn-warning btn-icon-split">
                                  <span class="icon">
                                      <i class="fas fa-edit"></i>
                                  </span>
                                  <span class="text">Edit</span>
                                </a>
                            </td>
                        </tr>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <div class="modal fade" id="modal-sfinal">
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Final Pengeluaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p>Yakin akan merubah status menjadi final?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="/pengeluaran/statusfinal/id" id="sfinal" type="button" class="btn btn-success">Final</a>
            </div>
          </div>
      </div>
    </div>
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

<script>
  function statusfinal(id) {
  $("#sfinal").attr("href", "/penggunaan/statusfinal/"+id);
  $('#modal-sfinal').modal('show');
  }
</script>
@endpush