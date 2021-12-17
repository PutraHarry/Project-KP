@extends('layouts.master')
@section('title')
Edit Saldo Awal
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
    </section>
    
    <!-- Main content -->
    <section>
        <form action="/saldoawal/update/{{ $idEdit }}" method="POST">
            @csrf
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Data Saldo </h3>
                                    <div class="card-tools">
                                        @if (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['PPBPB']))
                                            @if ($saldoawal->status_saldo == 'draft')
                                                <button type="submit" class="btn btn-danger btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                    <span class="text">Draft</span>
                                                </button>
                                                <button type="button" class="btn btn-success btn-icon-split" onclick="statusFinal({{ $idEdit }}, {{ $saldoawal->total }})">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                    <span class="text">Final</span>
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
                                                    <label for="kode_saldo">Kode Saldo</label>
                                                    <input type="text" class="form-control" name="kode_saldo" id="kode_saldo" value="{{ $saldoawal->kode_saldo }}" placeholder="Kode Saldo" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Saldo:</label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" name="tgl_input" id="tgl_input" value="{{ $saldoawal->tgl_input }}" @if($saldoawal->status_saldo == 'final') readonly @endif >
                                                    </div>  
                                                </div>  
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <input class="form-control" name="status_saldo" id="status_saldo" @if($saldoawal->status_saldo == 'draft') value="draft" @elseif($saldoawal->status_saldo == 'final') value="final" @endif readonly>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea class="form-control" rows="3" name="ket_saldo" id="ket_saldo" placeholder="Input Keterangan..." @if($saldoawal->status_saldo == 'final') readonly @endif>{{ $saldoawal->ket_saldo }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center">
                                                    <label>Total Harga:</label>
                                                    <h1>
                                                        <span class="text-bold">Rp.</span>
                                                        <span class="text-bold" id="totalHargaSaldoAwal">{{ $saldoawal->total }}</span>
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
                                                            <label>Nama Unit Kerja:</label>
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
        <form action="/saldoawal/updateDetail/{{ $idEdit }}" method="POST">
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
                                                    <th width="300px">Kategori Barang</th><!--ini tambahan baru-->
                                                    <th width="300px">Barang</th>
                                                    <th width="120px">Qty</th>
                                                    <th width="120px">Satuan</th>
                                                    <th width="120px">Harga</th>
                                                    <th width="120px">Total</th>
                                                    <th width="200px">Keterangan</th>
                                                    <th width="100px">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($detailSaldoAwal as $dsa)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td> {{ $dsa->barang->jenisBarang->jenis_barang }} </td><!--ini tambahan baru-->
                                                    <td> {{ $dsa->barang->nama_m_barang }} </td>
                                                    <td> {{ $dsa->qty }} </td>
                                                    <td> {{ $dsa->barang->satuan_m_barang }} </td>
                                                    <td> {{ $dsa->barang->harga_m_barang }} </td>
                                                    <td> {{ $dsa->harga }} </td>
                                                    <td> {{ $dsa->keterangan }} </td>
                                                    @if ($saldoawal->status_saldo == 'draft')
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm">
                                                                <button class="btn btn-warning" type="button" onclick="editsaldoawal({{ $dsa->id }},{{ $dsa->barang->jenisBarang->id }},{{ $dsa->barang->id }},{{ $dsa->qty }},'{{ $dsa->barang->satuan_m_barang }}',{{ $dsa->barang->harga_m_barang }},'{{ $dsa->keterangan }}')">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>
                                                            <div class="btn-group btn-group-sm">
                                                                <button class="btn btn-danger" type="button" value="{{ $dsa->id }}" id="btn_delete{{ $dsa->id }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    @else
                                                    <td class="text-center"></td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                                @if ($saldoawal->status_saldo == 'draft')
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td>
                                                            <div class="form-group"><!--ini tambahan baru-->
                                                              <select class="select2" name="kategori_barang" id="kategori_barang" data-placeholder="Pilih Jenis Barang" style="width: 100%;">
                                                                @foreach ($jenisBarang as $jb)
                                                                    <option value="{{ $jb->id }}">{{ $jb->jenis_barang }}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                          </td>
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
                                                @endif
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
    
    <div class="modal fade" id="modal-sedit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" id="edit_form" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Detail Saldo Awal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="select2" name="kategori_barang" id="edit_kategori_barang" data-placeholder="Pilih Barang" style="width: 100%;" disabled>
                            @foreach ($jenisBarang as $jb)
                                <option value="{{ $jb->id }}">{{ $jb->jenis_barang }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="select2" name="id_barang" id="edit_id_barang" data-placeholder="Pilih Barang" style="width: 100%;" disabled>
                            @foreach ($tbarang as $tb)
                                <option value="{{ $tb->id }}">{{ $tb->nama_m_barang }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="qty" id="edit_qty" placeholder="Kuantitas" value="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="satuan" id="edit_satuan" placeholder="Satuan" readonly>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="harga" id="edit_harga" placeholder="Harga" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="total" id="edit_total" placeholder="Kehitung otomatis" readonly>
                        </div>
                        <select class="form-control" name="keterangan" id="edit_keterangan">
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                        </select>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-sfinal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" id="finalSaldoAwal" method="POST">
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
                        <label>Kode Saldo Awal</label>
                        <input type="text" class="form-control" name="kodeSaldoAwal" id="kodeSaldoAwal" placeholder="Kode Penggunaan" value="" readonly>
                      </div>
                      <div class="form-group">
                        <label>Tanggal Saldo Awal</label>
                        <input type="text" class="form-control" name="tglSaldoAwal" id="tglSaldoAwal" placeholder="Tanggal Penggunaan" value="" readonly>
                      </div>
                      <div class="form-group">
                        <label>Total Saldo Awal</label>
                        <input type="text" class="form-control" name="totalSaldoAwal" id="totalSaldoAwal" placeholder="Total Saldo Awal" value="" readonly>
                      </div>
                      <div class="form-group">
                        <label>Keterangan Saldo Awal</label>
                        <input type="text" class="form-control" name="ketSaldoAwal" id="ketSaldoAwal" placeholder="Tanggal Penggunaan" value="" readonly>
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

  var jenis_id = $('#kategori_barang').val();
//   console.log(jenis_id);
  $.ajax({
    type: 'GET',
    url: '/saldoawal/barang/' + jenis_id,
    success: function (response){
        // console.log(response);
        $('#id_barang').empty();
        $('#id_barang').append('<option value=""> Pilih Barang </option>');
        response.forEach(element => {
            $('#id_barang').append('<option value="' + element['id'] + '"' +'>' + element['nama_m_barang'] + '</option>');
        });
    }
  });

  $('#kategori_barang').change(function() {
    if($('#kategori_barang').val() != ""){ 
        let id = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/saldoawal/barang/'+id,
            success: function (response){
            // console.log(response);
                $('#id_barang').empty();
                $('#id_barang').append('<option value=""> Pilih Barang </option>');
                response.forEach(element => {
                $('#id_barang').append('<option value="' + element['id'] + '"' +'>' + element['nama_m_barang'] + '</option>');
                });
            }
        });
    } 
  });
</script>

<script>
    $('#id_barang').change(function(){
        var id_barang = $('#id_barang').val();
        console.log(id_barang);
        var barang = {!! json_encode($tbarang->toArray()) !!}
        barang.forEach(element => {
            if(element.id == id_barang){
                $('#harga').val(element.harga_m_barang);
                $('#satuan').val(element.satuan_m_barang);
            }
        });
    })

    //Hitung total harga
    $('#qty').keyup(function(){
        $('#total').val($('#qty').val() * $('#harga').val());
    })
</script>

<script>
    var id_detail = {!! json_encode($detailSaldoAwal->toArray()) !!}
    id_detail.forEach(element => {
        $('#btn_delete'+element.id).click(function(){
            var id = $(this).val();
            console.log(id);
            $.ajax({
                type: 'GET',
                url: '/saldoawal/deleteDetail/'+id,
                success:function(response){
                    location.reload();
                }
            });
        })
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
    function editsaldoawal(id, id_jenis, id_barang, qty, satuan, harga, keterangan) {
        $("#edit_form").attr("action", "/saldoawal/editDetail/"+id);
        $('#edit_kategori_barang').val(id_jenis).change();
        $('#edit_id_barang').val(id_barang).change();
        $('#edit_qty').val(qty);
        $('#edit_satuan').val(satuan);
        $('#edit_harga').val(harga);
        $('#edit_keterangan').val(keterangan);
        $('#edit_total').val($('#edit_qty').val() * $('#edit_harga').val());
        $('#modal-sedit').modal('show');
    }
    
    $('#edit_kategori_barang').change(function() {
        if($('#edit_kategori_barang').val() != ""){ 
            let id = $(this).val();
            console.log(id);
            $.ajax({
                type: 'GET',
                url: '/saldoawal/barang/'+id,
                success: function (response){
                // console.log(response);
                    $('#edit_id_barang').empty();
                    // $('#edit_id_barang').append('<option value=""></option>');
                    response.forEach(element => {
                    $('#edit_id_barang').append('<option value="' + element['id'] + '"' +'>' + element['nama_m_barang'] + '</option>');
                    });
                }
            });
        } 
    });

    $('#edit_id_barang').change(function(){
        var id_barang = $('#edit_id_barang').val();
        var barang = {!! json_encode($tbarang->toArray()) !!}
        barang.forEach(element => {
            if(element.id == id_barang){
                $('#edit_harga').val(element.harga_m_barang);
                $('#edit_satuan').val(element.satuan_m_barang);
                $('#edit_total').val($('#edit_qty').val() * $('#edit_harga').val());
            }
        });
    })

    $('#edit_qty').keyup(function(){
        $('#edit_total').val($('#edit_qty').val() * $('#edit_harga').val());
    })
</script>

<script>
    function statusFinal(idEdit, total) {
      //var totalSaldoAwal = $('#totalHargaSaldoAwal').val();
      $("#finalSaldoAwal").attr("action", "/saldoawal/final/" + idEdit);
      $('#kodeSaldoAwal').val($('#kode_saldo').val());
      $('#tglSaldoAwal').val($('#tgl_input').val());
      $('#totalSaldoAwal').val(total);
      $('#ketSaldoAwal').val($('#ket_saldo').val());
      //console.log(total);
      $('#modal-sfinal').modal('show');
    }
</script>
@endpush