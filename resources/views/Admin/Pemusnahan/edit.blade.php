@extends('layouts.master')
@section('title')
Edit Pemusnahan Baru
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
              <li class="breadcrumb-item"><a href="/pemusnahan">Pemusnahan</a></li>
              <li class="breadcrumb-item active">Edit Pemusnahan</li>
            </ol>
          </div>
        </div>
        <div>
          <a href="/pemusnahan" class="btn btn-default btn-icon-split">
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
    <form action="/pemusnahan/update/{{ $tpemusnahan->id }}" method="POST">
      @csrf
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Data Pemusnahan</h3>
                  <div class="card-tools">
                    @if ($tpemusnahan->status_pemusnahan == 'draft')
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
                    @elseif (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['PPBP']))
                      <button class="btn btn-success btn-icon-split" type="button" onclick="statusDisetujuiPPBP({{ $idEdit }})">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Final</span>
                      </button>
                    @elseif (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['Kepala PD']))
                    <button class="btn btn-success btn-icon-split" type="button" onclick="statusDisetujuiKepalaPD({{ $idEdit }})">
                      <span class="icon text-white-50">
                          <i class="fas fa-check"></i>
                      </span>
                      <span class="text">Final</span>
                    </button>
                    @elseif (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['TIM VERIFIKASI']))
                      <button class="btn btn-success btn-icon-split" type="button" onclick="statusDisetujuiTimVerifikasi({{ $idEdit }})">
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
                              <label for="kode_Pemusnahan">Kode Pemusnahan</label>
                              <input type="text" class="form-control" name="kode_pemusnahan" id="kode_pemusnahan" placeholder="Kode Pemusnahan" value="{{ $tpemusnahan->kode_pemusnahan }}" readonly>
                          </div>
                          <div class="form-group">
                            <label>Kode Opname</label>
                            <select class="select2" name="id_opname" id="id_opname" data-placeholder="Pilih Nota Bukti Umum" style="width: 100%;" @if($tpemusnahan->status_pemusnahan == 'final') disabled @endif>
                              @foreach ($topname as $to)
                                <option value="{{ $to->id }}" @if($to->id == $tpemusnahan->id_opname) selected @endif>{{ $to->kode_opname }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                              <label>Tanggal Pemusnahan:</label>
                              <div class="input-group">
                                <input type="date" class="form-control" name="tgl_input" id="tgl_input" value="{{ $tpemusnahan->tgl_pemusnahan }}" @if($tpemusnahan->status_pemusnahan != 'draft') readonly @endif>
                              </div>  
                          </div>  
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label>Status</label>
                            <input class="form-control" name="status_pemusnahan" id="status_pemusnahan" @if($tpemusnahan->status_pemusnahan == 'draft') value="draft" @elseif($tpemusnahan->status_pemusnahan == 'final') value="final" @endif readonly>
                          </div>
                          <div class="form-group">
                              <label>Keterangan</label>
                              <textarea class="form-control" rows="5" name="ket_pemusnahan" id="ket_pemusnahan" placeholder="Input Keterangan..." @if($tpemusnahan->status_pemusnahan != 'draft') readonly @endif>{{ $tpemusnahan->ket_pemusnahan }}</textarea>
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
            <form action="" id="finalPemusnahan" method="POST">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Final Pemusnahan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div>
                    <span>Yakin akan merubah status menjadi final?</span>
                  </div>
                  <div class="form-group">
                    <label>Kode Pemusnahan</label>
                    <input type="text" class="form-control" name="kodePemusnahan" id="kodePemusnahan" placeholder="Kode Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Kode Opname</label>
                    <input type="text" class="form-control" name="kodeOpname" id="kodeOpname" placeholder="Kode Penerimaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pemusnahan</label>
                    <input type="text" class="form-control" name="tglPemusnahan" id="tglPemusnahan" placeholder="Tanggal Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Keterangan Pemusnahan</label>
                    <input type="text" class="form-control" name="ketPemusnahan" id="ketPemusnahan" placeholder="Tanggal Penggunaan" value="" readonly>
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
            <form action="" id="disetujuiPPBPPemusnahan" method="POST">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Disetujui PPBP Pemusnahan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div>
                    <span>Yakin akan merubah status menjadi disetujui PPBP?</span>
                  </div>
                  <div class="form-group">
                    <label>Kode Pemusnahan</label>
                    <input type="text" class="form-control" name="kodePemusnahan" id="kodePemusnahanDisetujuiPPBP" placeholder="Kode Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Kode Opname</label>
                    <input type="text" class="form-control" name="kodeOpname" id="kodeOpnameDisetujuiPPBP" placeholder="Kode Penerimaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pemusnahan</label>
                    <input type="text" class="form-control" name="tglPemusnahan" id="tglPemusnahanDisetujuiPPBP" placeholder="Tanggal Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Keterangan Pemusnahan</label>
                    <input type="text" class="form-control" name="ketPemusnahan" id="ketPemusnahanDisetujuiPPBP" placeholder="Tanggal Penggunaan" value="" readonly>
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
  <div class="modal fade" id="modal-sdisetujuiKepalaPD">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="disetujuiKepalaPDPemusnahan" method="POST">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Disetujui Kepala PD Pemusnahan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div>
                    <span>Yakin akan merubah status menjadi disetujui Kepala PD?</span>
                  </div>
                  <div class="form-group">
                    <label>Kode Pemusnahan</label>
                    <input type="text" class="form-control" name="kodePemusnahan" id="kodePemusnahanDisetujuiKepalaPD" placeholder="Kode Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Kode Opname</label>
                    <input type="text" class="form-control" name="kodeOpname" id="kodeOpnameDisetujuiKepalaPD" placeholder="Kode Penerimaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pemusnahan</label>
                    <input type="text" class="form-control" name="tglPemusnahan" id="tglPemusnahanDisetujuiKepalaPD" placeholder="Tanggal Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Keterangan Pemusnahan</label>
                    <input type="text" class="form-control" name="ketPemusnahan" id="ketPemusnahanDisetujuiKepalaPD" placeholder="Tanggal Penggunaan" value="" readonly>
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
  <div class="modal fade" id="modal-sdisetujuiTimVerifikasi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" id="disetujuiTimVerifikasiPemusnahan" method="POST">
              @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Disetujui Tim Verifikasi Pemusnahan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div>
                    <span>Yakin akan merubah status menjadi disetujui Tim Verifikasi?</span>
                  </div>
                  <div class="form-group">
                    <label>Kode Pemusnahan</label>
                    <input type="text" class="form-control" name="kodePemusnahan" id="kodePemusnahanDisetujuiTimVerifikasi" placeholder="Kode Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Kode Opname</label>
                    <input type="text" class="form-control" name="kodeOpname" id="kodeOpnameDisetujuiTimVerifikasi" placeholder="Kode Penerimaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pemusnahan</label>
                    <input type="text" class="form-control" name="tglPemusnahan" id="tglPemusnahanDisetujuiTimVerifikasi" placeholder="Tanggal Penggunaan" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Keterangan Pemusnahan</label>
                    <input type="text" class="form-control" name="ketPemusnahan" id="ketPemusnahanDisetujuiTimVerifikasi" placeholder="Tanggal Penggunaan" value="" readonly>
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

  let id = $('#id_opname').val();
  //console.log(id);
  $.ajax({
      type: 'GET',
      url: '/pemusnahan/detailOpname/'+id,
      success: function (response){
        //console.log(response);
          $('#data').empty();
          let count = 0;
          let total_harga = 0;
          response.forEach(element => {
            count = count + 1;
            total_harga = total_harga + element['harga'];
              $('#data').append('<tr><td class="text-center">'+count+'</td><td>Placeholder kategori barang</td><td>' + element.barang['nama_m_barang'] + '</td> <td>' + element['qty'] + '</td> <td>' + element.barang['satuan_m_barang'] + '</td> <td>' + element.barang['harga_m_barang'] + '</td> <td>' + element['harga'] + '</td> x<td>' + element['keterangan'] + '</td></tr>');
          });
          $('#total_harga').text(total_harga);
          total_harga = 0;
          count = 0;
      }
  });

  $('#id_opname').change(function() {
      if($('#id_opname').val() != ""){ 
          let id = $(this).val();
          $.ajax({
              type: 'GET',
              url: '/pengeluaran/detailOpname/'+id,
              success: function (response){
                console.log(response);
                  $('#data').empty();
                  let count = 0;
                  let total_harga = 0;
                  response.forEach(element => {
                    count = count + 1;
                    total_harga = total_harga + element['harga'];
                      $('#data').append('<tr><td class="text-center">' + count + '</td><td>Placeholder kategori barang</td><td>' + element.barang['nama_m_barang'] + '</td> <td>' + element['qty'] + '</td> <td>' + element.barang['satuan_m_barang'] + '</td> <td>' + element.barang['harga_m_barang'] + '</td> <td>' + element['harga'] + '</td> x<td>' + element['keterangan'] + '</td></tr>');
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
    var idOpname = $('#id_opname').val();
    var opname = {!! json_encode($topname->toArray()) !!}
    opname.forEach(element => {
      if(element.id == idOpname){
        $('#kodeOpname').val(element.kode_opname);
      }
    });
    console.log(idEdit);
    $("#finalPemusnahan").attr("action", "/pemusnahan/final/" + idEdit + "/detail/" + idOpname);
    $('#kodePemusnahan').val($('#kode_pemusnahan').val());
    $('#tglPemusnahan').val($('#tgl_input').val());
    $('#ketPemusnahan').val($('#ket_pemusnahan').val());
    $('#modal-sfinal').modal('show');
  }
</script>

<script>
  function statusDisetujuiPPBP(idEdit) {
    var idOpname = $('#id_opname').val();
    var opname = {!! json_encode($topname->toArray()) !!}
    opname.forEach(element => {
      if(element.id == idOpname){
        $('#kodeOpnameDisetujuiPPBP').val(element.kode_opname);
      }
    });
    console.log(idEdit);
    $("#disetujuiPPBPPemusnahan").attr("action", "/pemusnahan/disetujuippbp/" + idEdit);
    $('#kodePemusnahanDisetujuiPPBP').val($('#kode_pemusnahan').val());
    $('#tglPemusnahanDisetujuiPPBP').val($('#tgl_input').val());
    $('#ketPemusnahanDisetujuiPPBP').val($('#ket_pemusnahan').val());
    $('#modal-sdisetujuiPPBP').modal('show');
  }
</script>

<script>
  function statusDisetujuiKepalaPD(idEdit) {
    var idOpname = $('#id_opname').val();
    var opname = {!! json_encode($topname->toArray()) !!}
    opname.forEach(element => {
      if(element.id == idOpname){
        $('#kodeOpnameDisetujuiKepalaPD').val(element.kode_opname);
      }
    });
    console.log(idEdit);
    $("#disetujuiKepalaPDPemusnahan").attr("action", "/pemusnahan/disetujuikepalapd/" + idEdit);
    $('#kodePemusnahanDisetujuiKepalaPD').val($('#kode_pemusnahan').val());
    $('#tglPemusnahanDisetujuiKepalaPD').val($('#tgl_input').val());
    $('#ketPemusnahanDisetujuiKepalaPD').val($('#ket_pemusnahan').val());
    $('#modal-sdisetujuiKepalaPD').modal('show');
  }
</script>

<script>
  function statusDisetujuiTimVerfikasi(idEdit) {
    var idOpname = $('#id_opname').val();
    var opname = {!! json_encode($topname->toArray()) !!}
    opname.forEach(element => {
      if(element.id == idOpname){
        $('#kodeOpnameDisetujuiTimVerifikasi').val(element.kode_opname);
      }
    });
    console.log(idEdit);
    $("#disetujuiTimVerifikasiPemusnahan").attr("action", "/pemusnahan/disetujuitimverifikasi/" + idEdit);
    $('#kodePemusnahanDisetujuiTimVerifikasi').val($('#kode_pemusnahan').val());
    $('#tglPemusnahanDisetujuiTimVerifikasi').val($('#tgl_input').val());
    $('#ketPemusnahanDisetujuiTimVerifikasi').val($('#ket_pemusnahan').val());
    $('#modal-sdisetujuiTimVerifikasi').modal('show');
  }
</script>
@endpush