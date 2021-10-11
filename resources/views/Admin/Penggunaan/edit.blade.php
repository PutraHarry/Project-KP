@extends('layouts.master')
@section('title')
Edit Penggunaan
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
              <li class="breadcrumb-item active">Edit Penggunaan</li>
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
    <form action="#" method="POST">
      @csrf
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Data Penggunaan Barang Baru</h3>
                  <div class="card-tools">
                    <button type="submit" class="btn btn-danger btn-icon-split">
                      <span class="icon text-white-50">
                          <i class="fas fa-edit"></i>
                      </span>
                      <span class="text">Draft</span>
                    </button>
                    <button type="submit" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Final</span>
                      </button>
                  </div>
                </div>

                <form id="quickForm">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Tanggal Penggunaan Barang:</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="tgl_input" id="tgl_input" value="{{ $tpenggunaan->tgl_penggunaan }}">
                                </div>  
                            </div>
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status_penggunaan" id="status_penggunaan" disabled>
                            <option value="draft">Draft</option>
                            <option value="final">Final</option>
                            <option value="disetujui">Disetujui</option> <!--jika diaprove pembantu pengurus barang-->
                            <option value="approved">Approved</option> <!--hanya bisa oleh atasan langsung-->
                            </select>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="text-center">
                              <label>Total Harga:</label>
                              <h1>
                                <span class="text-bold">Rp.</span>
                                <span class="text-bold">10,000.000.000.000</span>
                              </h1>
                          </div>    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Kode Penerimaan</label>
                                <select class="select2" name="id_penerimaan" id="id_penerimaan" data-placeholder="Pilih Nota Bukti Umum" style="width: 100%;">
                                  @foreach($tpenerimaan as $tp)  
                                    <option value={{ $tp->id }} @if($tp->id == $tpenggunaan->id_penerimaan) selected @endif>{{ $tp->kode_penerimaan }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text">
                                <label>Lokasi Gudang:</label>
                                    <p>{{ Auth::guard('admin')->user()->unit->opd->nama_opd }}</p>
                                </select>
                            </div> 
                        </div>
                        <div class="col-3">
                            <div class="text">
                                <label>Lokasi Unit Kerja:</label>
                                    <p>{{ Auth::guard('admin')->user()->unit->unit }}</p>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th width="40px">No.</th>
                                        <th width="400px">Barang</th>
                                        <th width="120px">Qty</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th width="200px">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <div id="data"></div>
                                    </tr>
                                </tbody>
                            </table>
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

  $('#id_penerimaan').change(function() {
      if($('#id_penerimaan').val() != ""){ 
          let id = $(this).val();
          $.ajax({
              type: 'GET',
              url: '/penggunaan/detailPenerimaan/'+id,
              success: function (response){
                  $('#data').empty();
                  response.forEach(element => {
                      $('#data').append('<td class="text-center"></td>' + '<td>' + element['nama_m_barang'] + '</td> <td>' + element['qty'] + '</td> <td>' + element['satuan_m_barang'] + '</td> <td>' + element['harga_m_barang'] + '</td> <td>' + element['total'] + '</td> x<td>' + element['keterangan'] + '</td>');
                  });
              }
          });
      } 
  });
  
</script>
@endpush