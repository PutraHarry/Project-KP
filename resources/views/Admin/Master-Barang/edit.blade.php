@extends('layouts.master')
@section('title')
Edit Barang 
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
              <li class="breadcrumb-item"><a href="/barang">Kelola Barang</a></li>
              <li class="breadcrumb-item active">Edit Barang</li>
            </ol>
          </div>
        </div>
        <div>
            <a href="/master-barang" class="btn btn-default btn-icon-split">
                <span class="icon">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
          </div>
      </div>
    </section>
      
    <!-- Main content -->
    <form action="/barang/update/{{ $idEdit }}" method="POST">
      @csrf
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Data Barang</h3>
                </div>

                <form id="quickForm">
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Input Nama Barang" value="{{ $dataBarang->nama_m_barang }}">
                    </div>
                    <div class="form-group">
                        <label>Jenis Barang</label>
                        <select class="select2" name="jenis_barang" id="jenis_barang" data-placeholder="Pilih Unit Perangkat Daeerah" style="width: 100%;">
                          @foreach ($jenisBarang as $jb)
                            <option value="{{ $jb->id }}" @if($dataBarang->id_jenis == $jb->id) selected @endif>{{ $jb->jenis_barang }}</option>
                          @endforeach
                        </select>
                    </div>
                    
                    <div class="row">                        
                        <div class="col-3">
                            <div class="form-group">
                                <label for="exampleInputSatuan">Satuan</label>
                                <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="{{ $dataBarang->satuan_m_barang }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="exampleInputHarga">Harga Barang</label>
                                <input type="text" class="form-control" name="harga" id="harga" placeholder="Input Harga" value="{{ $dataBarang->harga_m_barang }}">
                            </div>
                        </div>
                    </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
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