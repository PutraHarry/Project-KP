@extends('layouts.master')
@section('title')
Edit Pengeluaran Baru
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
              <li class="breadcrumb-item"><a href="/pengeluaran">Pengeluaran</a></li>
              <li class="breadcrumb-item active">Edit Pengeluaran</li>
            </ol>
          </div>
        </div>
        <div>
          <a href="/pengeluaran" class="btn btn-default btn-icon-split">
              <span class="icon">
                  <i class="fas fa-arrow-left"></i>
              </span>
              <span class="text">Kembali</span>
          </a>
        </div>
      </div>
    </section>
      
    <!-- Main content -->
  <section>
    <form action="/pengeluaran/update/{{ $idEdit }}" method="POST">
      @csrf
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Data Pengeluaran</h3>
                  <div class="card-tools">
                    @if ($tpengeluaran->status_pengeluaran == 'draft')
                      <button type="submit" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Draft</span>
                      </button>
                      <button class="btn btn-success btn-icon-split" type="button" onclick="statusFinal({{ $idEdit }})">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Final</span>
                      </button>
                    @endif
                  </div>
                </div>

                <form id="quickForm">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                          <div class="form-group">
                              <label for="kode_pengeluaran">Kode Pengeluaran</label>
                              <input type="text" class="form-control" name="kode_pengeluaran" id="kode_pengeluaran" placeholder="Kode Pengeluaran" value="{{ $tpengeluaran->kode_pengeluaran }}" readonly>
                          </div>
                          <div class="form-group">
                            <label>Kode Penerimaan</label>
                            <select class="select2" name="id_penggunaan" id="id_penggunaan" data-placeholder="Kode Penerimaan" style="width: 100%;" @if($tpengeluaran->status_pengeluaran == 'final') disabled @endif>
                              @foreach($tpenggunaan as $tp)  
                                <option value={{ $tp->id }} @if($tp->id == $tpengeluaran->id_penggunaan) selected @endif>{{ $tp->kode_penggunaan }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                              <label>Tanggal Pengeluaran:</label>
                              <div class="input-group">
                                <input type="date" class="form-control" name="tgl_input" id="tgl_input" value="{{ $tpengeluaran->tgl_keluar }}" @if($tpengeluaran->status_pengeluaran == 'final') readonly @endif>
                              </div>  
                          </div>  
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label>Status</label>
                            <input class="form-control" name="status_pengeluaran" id="status_pengeluaran" value="draft" readonly>
                          </div>
                          <div class="form-group">
                              <label>Keterangan</label>
                              <textarea class="form-control" rows="5" name="ket_pengeluaran" id="ket_pengeluaran" placeholder="Input Keterangan..." @if($tpengeluaran->status_pengeluaran == 'final') readonly @endif>{{ $tpengeluaran->ket_pengeluaran }}</textarea>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="text-center">
                              <label>Total Harga:</label>
                              <h1>
                                <span class="text-bold">Rp.</span>
                                <span class="text-bold" id="total_harga"></span>
                              </h1>
                          </div>
                            <div class="row">
                              <div class="col-6">
                                <div class="text">
                                    <label>Nama OPD:</label>
                                    <p>{{ Auth::guard('admin')->user()->opd->nama_opd }}</p>
                                    </select>
                                </div> 
                              </div>
                              <div class="col-6">
                                <div class="text">
                                    <label>Lokasi Unit Kerja:</label>
                                    <p>{{ Auth::guard('admin')->user()->unit->unit }}</p>
                                    </select>
                                </div> 
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </form>
    <form action="/pengeluaran/updateDetail/{{ $idEdit }}" method="POST">
      @csrf
      <section class="content">
        <div class="container-fluid">
          <form id="quickForm">
            <div class="card card-default">
              <div class="card-body">
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
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!--
                        <tr>
                            <td class="text-center"></td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-warning" type="button" onclick="editpenerimaan()">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                </div>
                            </td>
                        </tr>
                        -->
                        
                          <tr>
                            <td class="text-center"></td>
                            <td>
                              <div class="form-group">
                                <select class="select2" name="id_barang" id="id_barang" data-placeholder="Pilih Barang" style="width: 100%;">
                                
                                </select>
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <input type="number" class="form-control" name="qty" id="qty" placeholder="Kuantitas">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <input type="text" class="form-control" name="total" id="total" placeholder="Kehitung otomatis" readonly>
                              </div>
                            </td>
                            <td>
                              <select class="form-control" name="keterangan">
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                              </select>
                            </td>
                            <td class="text-center">
                              <div class="btn-group btn-group-sm">
                                <button type="submit" class="btn btn-success">
                                  <i class="fas fa-check"></i>
                                </button>
                              </div>
                            </td>
                          </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>
    </form>
  </section>

  <div class="modal fade" id="modal-sfinal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="finalPengeluaran" method="POST">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Final Pengeluaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div>
                    <span>Yakin akan merubah status menjadi final?</span>
                  </div>
                  <div class="form-group">
                    <label>Kode Pengeluaran</label>
                    <input type="text" class="form-control" name="kodePengeluaran" id="kodePengeluaran" placeholder="Kode Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Kode Penggunaan</label>
                    <input type="text" class="form-control" name="kodePenggunaan" id="kodePenggunaan" placeholder="Kode Penerimaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pengeluaran</label>
                    <input type="text" class="form-control" name="tglPengeluaran" id="tglPengeluaran" placeholder="Tanggal Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Keterangan Pengeluaran</label>
                    <input type="text" class="form-control" name="ketPengeluaran" id="ketPengeluaran" placeholder="Tanggal Penggunaan" value="" readonly>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection

@push('js')
<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
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

  let id = $('#id_penggunaan').val();
  //console.log(id);
  $.ajax({
      type: 'GET',
      url: '/pengeluaran/detailPenggunaan/'+id,
      success: function (response){
        //console.log(response);
          $('#data').empty();
          let count = 0;
          let total_harga = 0;
          response.forEach(element => {
            count = count + 1;
            total_harga = total_harga + element['harga'];
              $('#data').append('<tr><td class="text-center">'+count+'</td><td>' + element.barang['nama_m_barang'] + '</td> <td>' + element['qty'] + '</td> <td>' + element.barang['satuan_m_barang'] + '</td> <td>' + element.barang['harga_m_barang'] + '</td> <td>' + element['harga'] + '</td> x<td>' + element['keterangan'] + '</td></tr>');
          });
          $('#total_harga').text(total_harga);
          total_harga = 0;
          count = 0;
      }
  });

  $('#id_penggunaan').change(function() {
      if($('#id_penggunaan').val() != ""){ 
          let id = $(this).val();
          $.ajax({
              type: 'GET',
              url: '/pengeluaran/detailPenggunaan/'+id,
              success: function (response){
                console.log(response);
                  $('#data').empty();
                  let count = 0;
                  let total_harga = 0;
                  response.forEach(element => {
                    count = count + 1;
                    total_harga = total_harga + element['harga'];
                      $('#data').append('<tr><td class="text-center">' + count + '</td><td>' + element.barang['nama_m_barang'] + '</td> <td>' + element['qty'] + '</td> <td>' + element.barang['satuan_m_barang'] + '</td> <td>' + element.barang['harga_m_barang'] + '</td> <td>' + element['harga'] + '</td> x<td>' + element['keterangan'] + '</td></tr>');
                  });
                  $('#total_harga').text(total_harga);
                  total_harga = 0;
                  count = 0;
              }
          });
      } 
  });
</script>

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
  function statusFinal(idEdit) {
    var idPenggunaan = $('#id_penggunaan').val();
    var penggunaan = {!! json_encode($tpenggunaan->toArray()) !!}
    penggunaan.forEach(element => {
      if(element.id == idPenggunaan){
        $('#kodePenggunaan').val(element.kode_penggunaan);
      }
    });
    //console.log(idEdit);
    $("#finalPengeluaran").attr("action", "/pengeluaran/final/" + idEdit + "/detail/" + idPenggunaan);
    $('#kodePengeluaran').val($('#kode_pengeluaran').val());
    $('#tglPengeluaran').val($('#tgl_input').val());
    $('#ketPengeluaran').val($('#ket_pengeluaran').val());
    $('#modal-sfinal').modal('show');
  }
</script>
@endpush