@extends('layouts.master')
@section('title')
    Kelola Barang
@endsection
@push('css')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
<!-- DataTables -->
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
            <li class="breadcrumb-item active">Kelola Barang</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  
  <div class="container-fluid">
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">List Data Barang</h3>
                      <div class="card-tools">                          
                          <div class="col-md-12">
                              <a href="/barang/create" class="btn btn-primary">
                                  <i class="fa fa-plus"></i> 
                                  Barang Baru
                              </a>
                          </div>
                      </div>
                  </div>
                  <div class="card-body table-responsive-md">
                      <div class="tab-content">
                          <div class="active tab-pane" id="kib-a">
                              <table id="data-kib-a" class="table table-responsive-md table-bordered table-hover">
                                  <thead>
                                      <tr class="text-center">
                                        <th width='50px'>No.</th>
                                        <th width='600px'>Nama</th>
                                        <th>Harga</th>
                                        <th>Satuan</th>
                                        <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($barang as $barang)
                                        <tr>
                                          <td class="text-center">{{ $loop->iteration }}</td>
                                          <td>{{ $barang->nama_m_barang }}</td>
                                          <td>{{ $barang->harga_m_barang }}</td>
                                          <td>{{ $barang->satuan_m_barang }}</td>
                                          <td class="text-center">
                                            <a href="barang/edit/{{ $barang->id }}" class="btn btn-warning btn-icon-split">
                                              <span class="icon">
                                                  <i class="fas fa-edit"></i>
                                              </span>
                                            </a>
                                            <a onclick="statusdelete({{ $barang->id }})" class="btn btn-danger btn-icon-split">
                                                <span class="icon">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                              </a>
                                          </td>
                                        </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                        </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
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

<script src="/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $('#data-kib-a').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#data-kib-b').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#data-kib-c').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#data-kib-d').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#data-kib-e').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#data-kib-f').DataTable({
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
  function statusdelete(id) {
  $("#sdelete").attr("action", "/barang/delete/"+id);
  $('#modal-sdelete').modal('show');
  }
</script>    
                    

    
@endpush