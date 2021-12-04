@extends('layouts.master')
@section('title')
Create Penggunaan Baru
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
            <h1>Persediaan Kab Badung</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/penggunaan">Penggunaan</a></li>
              <li class="breadcrumb-item active">Penggunaan Baru</li>
            </ol>
          </div>
        </div>
        <div>
          <a href="/penggunaan" class="btn btn-default btn-icon-split">
              <span class="icon">
                  <i class="fas fa-arrow-left"></i>
              </span>
              <span class="text">Kembali</span>
          </a>
        </div>
      </div>
    </section>
      
    <!-- Main content -->
    <form action="/penggunaan/insert" method="POST">
      @csrf
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Input Data Penggunaan Barang Baru</h3>
                  <div class="card-tools">
                    <button type="submit" class="btn btn-danger btn-icon-split">
                      <span class="icon text-white-50">
                          <i class="fas fa-edit"></i>
                      </span>
                      <span class="text">Draft</span>
                    </button>
                  </div>
                </div>
                <form id="quickForm">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Kode Penggunaan Barang:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="kode_penggunaan" id="kode_penggunaan" placeholder="Input Kode Penggunaan" readonly>
                                </div>  
                            </div>
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label>Status</label>
                            <input class="form-control" name="status_saldo" id="status_saldo" value="draft" readonly>
                            </select>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="text-center">
                              <label>Total Harga:</label>
                              <h1>
                                <span class="text-bold">Rp.</span>
                                <span class="text-bold">0</span>
                              </h1>
                          </div>    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Kode Penerimaan</label>
                                <select class="select2" name="id_penerimaan" id="id_penerimaan" data-placeholder="Pilih Nota Bukti Umum" style="width: 100%;">
                                  @foreach ($tpenerimaan as $tp)
                                    <option value={{ $tp->id }}>{{ $tp->kode_penerimaan }}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Keterangan</label>
                              <textarea class="form-control" rows="3" name="ket_penggunaan" id="ket_penggunaan" placeholder="Input Keterangan..."></textarea>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Tanggal Penggunaan Barang:</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="tgl_input" id="tgl_input">
                                </div>  
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Lokasi Gudang:</label>
                                    <p id="nama_opd">{{ Auth::guard('admin')->user()->opd->nama_opd }}</p>
                                </select>
                            </div> 
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Lokasi Unit Kerja:</label>
                                  <div class="input-group">
                                    <p id="nama_unit">{{ Auth::guard('admin')->user()->unit->unit }}</p>
                                  </div>
                                </select>
                            </div> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
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