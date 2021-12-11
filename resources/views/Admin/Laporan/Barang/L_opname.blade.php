@extends('layouts.master')
@section('title')
    Laporan Opname
@endsection
@push('css')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="/adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
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
              <li class="breadcrumb-item active"><a href="/laporan">Laporan</a></li>
              <li class="breadcrumb-item active">Laporan Opname</li>
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
                    <div class="card-tools">
                      @if (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['PPBPB', 'PPBP']))
                        <a href="#" class="btn btn-primary btn-icon-split">
                            <span class="icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Ekspor PDF</span>
                        </a>
                      @endif
                    </div>
                    <div>
                        <a href="/opname" class="btn btn-default btn-icon-split">
                            <span class="icon">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                    </div>
                </div>

                
                <!-- /.card-header -->
                <form action="#">
                    <div class="row ">
                            <div class="col-md-12">
                              <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title">Laporan Opname Persediaan</h3>
                                </div>
                
                                <form class="form-horizontal">
                                    <div class="card-body mx-lg-5">
                                      <div class="form-group row">
                                        <label for="inputOPD" class="col-sm-1 col-form-label">OPD</label>
                                        <div class="col-sm-11">
                                          <select class="select2" name="" id="" style="width: 100%">
                                              <option>OPD 1</option>
                                              <option>BPKAD</option>
                                              <option>KOMINFO</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="inputOPD" class="col-sm-1 col-form-label">Periode</label>
                                        <div class="col-sm-11">
                                          <select class="select2" name="" id="" style="width: 100%">
                                              <option>OPD 1</option>
                                              <option>BPKAD</option>
                                              <option>KOMINFO</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="inputOPD" class="col-sm-1 col-form-label">Kategori</label>
                                        <div class="col-sm-11">
                                          <select class="select2" name="" id="" style="width: 100%">
                                              <option>OPD 1</option>
                                              <option>BPKAD</option>
                                              <option>KOMINFO</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="inputOPD" class="col-sm-1 col-form-label">Unit Kerja</label>
                                        <div class="col-sm-11">
                                          <select class="select2" name="" id="" style="width: 100%">
                                              <option>OPD 1</option>
                                              <option>BPKAD</option>
                                              <option>KOMINFO</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="inputOPD" class="col-sm-1 col-form-label">Kegiatan</label>
                                        <div class="col-sm-11">
                                          <select class="select2" name="" id="" style="width: 100%">
                                            <option>OPD 1</option>
                                            <option>BPKAD</option>
                                            <option>KOMINFO</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="inputOPD" class="col-sm-1 col-form-label">Periode Stok</label>
                                        <div class="col-sm-11">
                                          <select class="select2" name="" id="" style="width: 100%">
                                              <option>OPD 1</option>
                                              <option>BPKAD</option>
                                              <option>KOMINFO</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                      <button type="submit" class="btn btn-info">Sign in</button>
                                      <button type="submit" class="btn btn-default float-right">Cancel</button>
                                    </div>
                                    <!-- /.card-footer -->
                                </form>
                              </div>  
                            </div>
                          </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
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
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'
})
//Bootstrap Duallistbox
$('.duallistbox').bootstrapDualListbox()

$("input[data-bootstrap-switch]").each(function(){
  $(this).bootstrapSwitch('state', $(this).prop('checked'));
})

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
  function statusdelete(id) {
  $("#sdelete").attr("action", "/saldoawal/delete/"+id);
  $('#modal-sdelete').modal('show');
  }
</script>
@endpush