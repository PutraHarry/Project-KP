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
  <section>
    <form action="/penggunaan/update/{{ $idEdit }}" method="POST">
      @csrf
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Data Penggunaan Barang Baru</h3>
                  <div class="card-tools">
                    @if (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['PPBPB']))
                      @if ($tpenggunaan->status_penggunaan == 'draft')
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
                    @elseif (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['KASI']))
                      @if ($tpenggunaan->status_penggunaan == 'final')
                        <button class="btn btn-success btn-icon-split" type="button" onclick="statusApproved({{ $idEdit }})">
                          <span class="icon text-white-50">
                              <i class="fas fa-check"></i>
                          </span>
                          <span class="text">Approved</span>
                        </button>
                      @endif
                    @elseif (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['PPBP']))
                      @if ($tpenggunaan->status_penggunaan == 'approved')
                        <button class="btn btn-success btn-icon-split" type="button" onclick="statusDisetujuiPPBP({{ $idEdit }})">
                          <span class="icon text-white-50">
                              <i class="fas fa-check"></i>
                          </span>
                          <span class="text">Disetujui PPBP</span>
                        </button>
                      @endif
                    @elseif (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['KASUBAG']))
                      @if ($tpenggunaan->status_penggunaan == 'disetujui_ppbp')
                        <button class="btn btn-success btn-icon-split" type="button" onclick="statusDisetujuiKASUBAG({{ $idEdit }})">
                          <span class="icon text-white-50">
                              <i class="fas fa-check"></i>
                          </span>
                          <span class="text">Disetujui Atassan Langsung</span>
                        </button>
                      @endif
                    @endif
                  </div>
                </div>
                <form id="quickForm">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Kode Penggunaan Barang:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="kode_penggunaan" id="kode_penggunaan" value="{{ $tpenggunaan->kode_penggunaan }}" readonly>
                                </div>  
                            </div>
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label>Status</label>
                              <input class="form-control" name="status_saldo" id="status_saldo" @if($tpenggunaan->status_penggunaan == 'draft') value="draft" @elseif($tpenggunaan->status_penggunaan == 'final') value="final" @elseif($tpenggunaan->status_penggunaan == 'approved') value="approved" @elseif($tpenggunaan->status_penggunaan == 'disetujui_ppbp') value="disetujui_ppbp" @elseif($tpenggunaan->status_penggunaan == 'disetujui_atasanLangsung') value="disetujui_atasanLangsung" @endif readonly>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Kode Penerimaan</label>
                                <select class="select2" name="id_penerimaan" id="id_penerimaan" data-placeholder="Pilih Nota Bukti Umum" style="width: 100%;" @if($tpenggunaan->status_penggunaan != 'draft') disabled @endif>
                                  @foreach($tpenerimaan as $tp)  
                                    <option value="{{ $tp->id }}" @if($tp->id == $tpenggunaan->id_penerimaan) selected @endif>{{ $tp->kode_penerimaan }}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Keterangan</label>
                              <textarea class="form-control" rows="3" name="ket_penggunaan" id="ket_penggunaan" placeholder="Input Keterangan..." @if($tpenggunaan->status_penggunaan != 'draft') readonly @endif>{{ $tpenggunaan->ket_penggunaan }}</textarea>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Tanggal Penggunaan Barang:</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="tgl_input" id="tgl_input" value="{{ $tpenggunaan->tgl_penggunaan }}" @if($tpenggunaan->status_penggunaan != 'draft') readonly @endif>
                                </div>  
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
                                      <th width="300px">Kategori Barang</th><!--ini tambahan baru sama cek juga di jquery variabel #data ada tak tambah-->
                                      <th width="300px">Barang</th>
                                      <th width="120px">Qty</th>
                                      <th width="120px">Satuan</th>
                                      <th width="120px">Harga</th>
                                      <th width="120px">Total</th>
                                      <th width="200px">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
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
  </section>
  
  <div class="modal fade" id="modal-sfinal">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form action="" id="finalPenggunaan" method="POST">
                @csrf
                  <div class="modal-header">
                      <h4 class="modal-title">Final Penggunaan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <div>
                      <span>Yakin akan merubah status menjadi final?</span>
                    </div>
                    <div class="form-group">
                      <label>Kode Penggunaan</label>
                      <input type="text" class="form-control" name="kodePenggunaan" id="kodePenggunaan" placeholder="Kode Penggunaan" value="" readonly>
                    </div>
                    <div class="form-group">
                      <label>Kode Penerimaan</label>
                      <input type="text" class="form-control" name="kodePenerimaan" id="kodePenerimaan" placeholder="Kode Penerimaan" value="" readonly>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Penggunaan</label>
                      <input type="text" class="form-control" name="tglPenggunaan" id="tglPenggunaan" placeholder="Tanggal Penggunaan" value="" readonly>
                    </div>
                    <div class="form-group">
                      <label>Keterangan</label>
                      <input type="text" class="form-control" name="ketPenggunaan" id="ketPenggunaan" placeholder="Tanggal Penggunaan" value="" readonly>
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

  <div class="modal fade" id="modal-sapproved">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="approvedPenggunaan" method="POST">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Approved Penggunaan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div>
                    <span>Yakin akan merubah status menjadi approved?</span>
                  </div>
                  <div class="form-group">
                    <label>Kode Penggunaan</label>
                    <input type="text" class="form-control" name="kodePenggunaan" id="kodePenggunaanApproved" placeholder="Kode Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Kode Penerimaan</label>
                    <input type="text" class="form-control" name="kodePenerimaan" id="kodePenerimaanApproved" placeholder="Kode Penerimaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Penggunaan</label>
                    <input type="text" class="form-control" name="tglPenggunaan" id="tglPenggunaanApproved" placeholder="Tanggal Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" name="ketPenggunaan" id="ketPenggunaanApproved" placeholder="Tanggal Penggunaan" value="" readonly>
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

  <div class="modal fade" id="modal-sdisetujuiPPBP">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="disetujuiPPBPPenggunaan" method="POST">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Disetujui PPBP Penggunaan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div>
                    <span>Yakin akan merubah status menjadi Disetujui PPBP?</span>
                  </div>
                  <div class="form-group">
                    <label>Kode Penggunaan</label>
                    <input type="text" class="form-control" name="kodePenggunaan" id="kodePenggunaanDisetujuiPPBP" placeholder="Kode Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Kode Penerimaan</label>
                    <input type="text" class="form-control" name="kodePenerimaan" id="kodePenerimaanDisetujuiPPBP" placeholder="Kode Penerimaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Penggunaan</label>
                    <input type="text" class="form-control" name="tglPenggunaan" id="tglPenggunaanDisetujuiPPBP" placeholder="Tanggal Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" name="ketPenggunaan" id="ketPenggunaanDisetujuiPPBP" placeholder="Tanggal Penggunaan" value="" readonly>
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

  <div class="modal fade" id="modal-sdisetujuiKASUBAG">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="disetujuiKASUBAGPenggunaan" method="POST">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Disetujui KASUBAG Penggunaan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div>
                    <span>Yakin akan merubah status menjadi Disetujui KASUBAG?</span>
                  </div>
                  <div class="form-group">
                    <label>Kode Penggunaan</label>
                    <input type="text" class="form-control" name="kodePenggunaan" id="kodePenggunaanDisetujuiKasubag" placeholder="Kode Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Kode Penerimaan</label>
                    <input type="text" class="form-control" name="kodePenerimaan" id="kodePenerimaanDisetujuiKasubag" placeholder="Kode Penerimaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Penggunaan</label>
                    <input type="text" class="form-control" name="tglPenggunaan" id="tglPenggunaanDisetujuiKasubag" placeholder="Tanggal Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" name="ketPenggunaan" id="ketPenggunaanDisetujuiKasubag" placeholder="Tanggal Penggunaan" value="" readonly>
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

  let id = $('#id_penerimaan').val();
  $.ajax({
      type: 'GET',
      url: '/penggunaan/detailPenerimaan/'+id,
      success: function (response){
        // console.log(response);
          $('#data').empty();
          let count = 0;
          let total_harga = 0;
          response.forEach(element => {
            count = count + 1;
            total_harga = total_harga + element['harga'];
              $('#data').append('<tr><td class="text-center">'+count+'</td><td>'+ element.barang.jenis_barang['jenis_barang'] +'</td><td>' + element.barang['nama_m_barang'] + '</td> <td>' + element['qty'] + '</td> <td>' + element.barang['satuan_m_barang'] + '</td> <td>' + element.barang['harga_m_barang'] + '</td> <td>' + element['harga'] + '</td> x<td>' + element['keterangan'] + '</td></tr>');
          });
          $('#total_harga').text(total_harga);
          total_harga = 0;
          count = 0;
      }
  });

  $('#id_penerimaan').change(function() {
      if($('#id_penerimaan').val() != ""){ 
          let id = $(this).val();
          $.ajax({
              type: 'GET',
              url: '/penggunaan/detailPenerimaan/'+id,
              success: function (response){
                console.log(response);
                  $('#data').empty();
                  let count = 0;
                  let total_harga = 0;
                  response.forEach(element => {
                    count = count + 1;
                    total_harga = total_harga + element['harga'];
                      $('#data').append('<tr><td class="text-center">' + count + '</td><td>'+ element.barang.jenis_barang['jenis_barang'] +'</td><td>' + element.barang['nama_m_barang'] + '</td> <td>' + element['qty'] + '</td> <td>' + element.barang['satuan_m_barang'] + '</td> <td>' + element.barang['harga_m_barang'] + '</td> <td>' + element['harga'] + '</td> x<td>' + element['keterangan'] + '</td></tr>');
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
    var idPenerimaan = $('#id_penerimaan').val();
    var penerimaan = {!! json_encode($tpenerimaan->toArray()) !!}
    penerimaan.forEach(element => {
      if(element.id == idPenerimaan){
        $('#kodePenerimaan').val(element.kode_penerimaan);
      }
    });
    //console.log(idEdit);
    $("#finalPenggunaan").attr("action", "/penggunaan/final/" + idEdit + "/detail/" + idPenerimaan);
    $('#kodePenggunaan').val($('#kode_penggunaan').val());
    $('#tglPenggunaan').val($('#tgl_input').val());
    $('#ketPenggunaan').val($('#ket_penggunaan').val());
    $('#modal-sfinal').modal('show');
  }

  function statusApproved(idEdit) {
    var idPenerimaan = $('#id_penerimaan').val();
    var penerimaan = {!! json_encode($tpenerimaan->toArray()) !!}
    penerimaan.forEach(element => {
      if(element.id == idPenerimaan){
        $('#kodePenerimaanApproved').val(element.kode_penerimaan);
      }
    });
    //console.log(idEdit);
    $("#approvedPenggunaan").attr("action", "/penggunaan/approved/" + idEdit);
    $('#kodePenggunaanApproved').val($('#kode_penggunaan').val());
    $('#tglPenggunaanApproved').val($('#tgl_input').val());
    $('#ketPenggunaanApproved').val($('#ket_penggunaan').val());
    $('#modal-sapproved').modal('show');
  }

  function statusDisetujuiPPBP(idEdit) {
    var idPenerimaan = $('#id_penerimaan').val();
    // console.log(idPenerimaan);
    var penerimaan = {!! json_encode($tpenerimaan->toArray()) !!}
    // console.log(penerimaan);
    penerimaan.forEach(element => {
      if(element.id == idPenerimaan){
        $('#kodePenerimaanDisetujuiPPBP').val(element.kode_penerimaan);
      }
    });
    //console.log(idEdit);
    $("#disetujuiPPBPPenggunaan").attr("action", "/penggunaan/disetujui_ppbp/" + idEdit);
    $('#kodePenggunaanDisetujuiPPBP').val($('#kode_penggunaan').val());
    $('#tglPenggunaanDisetujuiPPBP').val($('#tgl_input').val());
    $('#ketPenggunaanDisetujuiPPBP').val($('#ket_penggunaan').val());
    $('#modal-sdisetujuiPPBP').modal('show');
  }

  function statusDisetujuiKASUBAG(idEdit) {
    var idPenerimaan = $('#id_penerimaan').val();
    var penerimaan = {!! json_encode($tpenerimaan->toArray()) !!}
    penerimaan.forEach(element => {
      if(element.id == idPenerimaan){
        $('#kodePenerimaanDisetujuiKasubag').val(element.kode_penerimaan);
      }
    });
    //console.log(idEdit);
    $("#disetujuiKASUBAGPenggunaan").attr("action", "/penggunaan/disetujui_atasanLangsung/" + idEdit);
    $('#kodePenggunaanDisetujuiKasubag').val($('#kode_penggunaan').val());
    $('#tglPenggunaanDisetujuiKasubag').val($('#tgl_input').val());
    $('#ketPenggunaanDisetujuiKasubag').val($('#ket_penggunaan').val());
    $('#modal-sdisetujuiKASUBAG').modal('show');
  }
</script>
@endpush