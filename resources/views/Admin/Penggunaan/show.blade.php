@extends('layouts.master')
@section('title')
    Penggunaan
@endsection
@push('css')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
              <li class="breadcrumb-item active">Penggunaan</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      @if (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['PPBP', 'KASI', 'KASUBAG']))
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Filter Data Penggunaan Barang</h3>
                </div>
                <div class="card-body">
                  <form action="#">
                    <form class="form-horizontal">
                      <div class="card-body mx-lg-5">
                        <div class="form-group row">
                          <label for="Filter Data Penggunaan" class="col-sm-2 col-form-label">Status Penggunaan</label>
                          <div class="col-sm-10">
                            <select class="select2" name="filter_penggunaan" id="filter_penggunaan" placeholder="Status Penggunaan" style="width: 100%">
                              <option value="1">Belum diproses</option>
                              <option value="2">Semua Data</option>
                            </select>
                          </div>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Data Penggunaan Barang</h3>
                  <div class="card-tools">
                    @if (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['PPBPB']))
                      <a href="/penggunaan/create" class="btn btn-primary btn-icon-split">
                          <span class="icon">
                              <i class="fas fa-plus"></i>
                          </span>
                          <span class="text">Buat Baru</span>
                      </a>
                    @endif
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="data">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="modal-sdelete">
      <div class="modal-dialog">
          <div class="modal-content">
            <form action="" id="sdelete" method="POST">
            @csrf
              <div class="modal-header">
                  <h4 class="modal-title">Final Saldo</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
              <p>Yakin akan menghapus data?</p>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button id="sdelete" type="submit" class="btn btn-danger">Delete</button>
              </div>
          </div>
        </form>
      </div>
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
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
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
  let id = $('#filter_penggunaan').val();
  // console.log(id);
  $.ajax({
      type: 'GET',
      url: '/penggunaan/datapenggunaanPPBP/'+id,
      success: function (response){
        console.log(response);
          $('#data').empty();
          $('#data').html(response);
      }
  });

  $('#filter_penggunaan').change(function() {
      if($('#filter_penggunaan').val() != ""){ 
        let id = $('#filter_penggunaan').val();
        console.log(id);
        $.ajax({
            type: 'GET',
            url: '/penggunaan/datapenggunaanPPBP/'+id,
            success: function (response){
              console.log(response);
              $('#data').empty();
              $('#data').html(response);
            }
        });
      } 
  });
</script>

<script>
  function statusdelete(id) {
  $("#sdelete").attr("action", "/penggunaan/delete/"+id);
  $('#modal-sdelete').modal('show');
  }
</script>
@endpush