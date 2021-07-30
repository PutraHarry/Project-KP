@extends('layouts.master')
@section('title')
Edit Saldo Awal Baru
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
                    <h1>Data Saldo Awal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/saldoawal">Saldo awal</a></li>
                    <li class="breadcrumb-item active">Edit Saldo Awal</li>
                    </ol>
                </div>
            </div>
            <div>
                <a href="/saldoawal" class="btn btn-default btn-icon-split">
                    <span class="icon">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <form action="/saldoawal/update/{{ $saldoawal->id }}" method="POST">
        @csrf
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Data Saldo Baru</h3>
                                <div class="card-tools">
                                    <button type="submit" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Draft</span>
                                    </button>
                                    <button class="btn btn-success btn-icon-split" onclick="statusfinal({{ $saldoawal->id }})">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Final</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- form start -->
                    <form id="quickForm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Kode Saldo</label>
                                        <input type="text" class="form-control" name="kode_saldo" id="kode_saldo" value="{{ $saldoawal->kode_saldo }}" placeholder="Kode Saldo" disabled>
                                    </div>                               
                                    <div class="form-group">
                                        <label>Tanggal Saldo:</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="tgl_input" id="tgl_input" value="{{ $saldoawal->tgl_input }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status_saldo" id="status_saldo" disabled>
                                        <option value="{{ $saldoawal->status_saldo }}">{{ $saldoawal->status_saldo }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" rows="3" name="ket_saldo" id="ket_saldo" placeholder="Input Keterangan...">{{ $saldoawal->ket_saldo }}</textarea>
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
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text">
                                                <label>Nama OPD:</label>
                                                <p>Badan Pengelola Keuangan dan Aset Daerah</p>
                                            </div> 
                                        </div>
                                        <div class="col-6">
                                            <div class="text">
                                                <label>Nama Unit Kerja:</label>
                                                <p>Persediaan</p>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <a href="#" class="btn btn-warning btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-exchange"></i>
                                            </span>
                                            <span class="text">Ubah Data</span>
                                        </a>
                                    </div>
                                </div>
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
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="select2" name="#" id="#" data-placeholder="Pilih Barang" style="width: 100%;">
                                                        <option>barang1</option>
                                                        <option>barang3</option>
                                                        <option>barang2</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="qty" id="inputQty" placeholder="Kuantitas">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="satuan" id="inputSatuan" placeholder="Satuan">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="harga" id="inputHarga" placeholder="Harga">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="total" id="inputTotal" placeholder="Kehitung otomatis" disabled>
                                                    </div>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="keterangan">
                                                    <option value="baik">Baik</option>
                                                    <option value="rusak">Rusak</option>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-success"><i class="fas fa-check"></i><a>
                                                        <button class="btn btn-sm btn-flat btn-danger" onclick="#"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot> 
                                            <tr class="text-center">
                                                <th width="40px">No.</th>
                                                <th width="400px">Barang</th>
                                                <th>Qty</th>
                                                <th>Satuan</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr> 
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>    
            </div><!-- /.container-fluid -->
        </section>
    </form>
    <!-- /.content -->

    <div class="modal fade" id="modal-sfinal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Final Saldo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p>Yakin akan merubah status menjadi final?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="/saldoawal/statusfinal/id" id="sfinal" type="button" class="btn btn-success">Final</a>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
<script>
    function statusfinal(id) {
    $("#sfinal").attr("href", "/saldoawal/statusfinal/"+id);
    $('#modal-sfinal').modal('show');
    }
    </script>


@endpush