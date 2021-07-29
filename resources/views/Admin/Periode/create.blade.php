@extends('layouts.master')
@section('title')
Create Periode Baru
@endsection

@push('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="/adminlte/plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="/adminlte/plugins/dropzone/min/dropzone.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Periode Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/periode">Periode</a></li>
              <li class="breadcrumb-item active">Periode Baru</li>
            </ol>
          </div>
        </div>
        <div>
            <a href="/periode" class="btn btn-default btn-icon-split">
                <span class="icon">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
          </div>
      </div><!-- /.container-fluid -->
    </section>
      
          <!-- Main content -->
        <form action="/periode/insert" method="POST">
          @csrf
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Input Data Periode Baru</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="quickForm">
                      <div class="card-body">
        
                        <div class="form-group">
                            <label>Perangkat Daerah</label>
                            <select class="select2" name="id_opd" id="id_opd" data-placeholder="Pilih Perangkat Daeerah" style="width: 100%;">
                            @foreach($topd as $to)
                            <option value={{ $to->id }}>{{ $to->nama_opd }}</option>
                            @endforeach
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Periode</label>
                            <input type="text" class="form-control" name="nama_periode" id="nama_periode" placeholder="Input Nama Periode">
                        </div>
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                            <label>Tanggal Mulai:</label>
        
                            <div class="input-group">
                            <input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                            <label>Tanggal Selesai:</label>
                            <div class="input-group">
                            <input type="date" class="form-control" name="tgl_selesai" id="tgl_selesai">
                            </div>
                            <!-- /.input group -->
                        </div>
                            <!-- /.form group -->
                        
                        <!-- select -->
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status_periode" id="status_periode">
                            <option value="open">Open</option>
                            <option value="close">Close</option>
                            </select>
                        </div>
                        
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="3" name="ket_periode" id="ket_periode" placeholder="Input Keterangan..."></textarea>
                        </div>
                        <!--<div class="form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>-->
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.card -->
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
        </form>
@endsection

@push('js')

<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="/adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
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

  })
  
</script>


@endpush