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
                      <div class="row">
                        <div class="col-md-6 p-2">
                            <ul class="nav nav-pills d-flex justify-content-center justify-content-md-start">
                                <li class="nav-item"><a class="nav-link active" href="#kib-a" data-toggle="tab">KIB A</a></li>
                                <li class="nav-item"><a class="nav-link" href="#kib-b" data-toggle="tab">KIB B</a></li>
                                <li class="nav-item"><a class="nav-link" href="#kib-c" data-toggle="tab">KIB C</a></li>
                                <li class="nav-item"><a class="nav-link" href="#kib-d" data-toggle="tab">KIB D</a></li>
                                <li class="nav-item"><a class="nav-link" href="#kib-e" data-toggle="tab">KIB E</a></li>
                                <li class="nav-item"><a class="nav-link" href="#kib-f" data-toggle="tab">KIB F</a></li>
                            </ul>
                        </div>
                      </div>
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
                                      @foreach ($barangKIBA as $kiba)
                                        <tr>
                                          <td class="text-center">{{ $loop->iteration }}</td>
                                          <td>{{ $kiba->nama_m_barang }}</td>
                                          <td>{{ $kiba->harga_m_barang }}</td>
                                          <td>{{ $kiba->satuan_m_barang }}</td>
                                          <td class="text-center">
                                            <a href="barang/edit/{{ $kiba->id }}" class="btn btn-warning btn-icon-split">
                                              <span class="icon">
                                                  <i class="fas fa-edit"></i>
                                              </span>
                                            </a>
                                            <a onclick="statusdelete({{ $kiba->id }})" class="btn btn-danger btn-icon-split">
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
                          <div class="tab-pane" id="kib-b">
                              <table id="data-kib-b" class="table table-responsive-md table-bordered table-hover">
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
                                    @foreach ($barangKIBB as $kibb)
                                      <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $kibb->nama_m_barang }}</td>
                                        <td>{{ $kibb->harga_m_barang }}</td>
                                        <td>{{ $kibb->satuan_m_barang }}</td>
                                        <td class="text-center">
                                          <a href="barang/edit/{{ $kibb->id }}" class="btn btn-warning btn-icon-split">
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                          </a>
                                          <a onclick="statusdelete({{ $kibb->id }})" class="btn btn-danger btn-icon-split">
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
                          <div class="tab-pane" id="kib-c">
                            <table id="data-kib-c" class="table table-responsive-md table-bordered table-hover">
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
                                  @foreach ($barangKIBC as $kibc)
                                    <tr>
                                      <td class="text-center">{{ $loop->iteration }}</td>
                                      <td>{{ $kibc->nama_m_barang }}</td>
                                      <td>{{ $kibc->harga_m_barang }}</td>
                                      <td>{{ $kibc->satuan_m_barang }}</td>
                                      <td class="text-center">
                                        <a href="barang/edit/{{ $kibc->id }}" class="btn btn-warning btn-icon-split">
                                          <span class="icon">
                                              <i class="fas fa-edit"></i>
                                          </span>
                                        </a>
                                        <a onclick="statusdelete({{ $kibc->id }})" class="btn btn-danger btn-icon-split">
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
                        <div class="tab-pane" id="kib-d">
                            <table id="data-kib-d" class="table table-responsive-md table-bordered table-hover">
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
                                  @foreach ($barangKIBD as $kibd)
                                    <tr>
                                      <td class="text-center">{{ $loop->iteration }}</td>
                                      <td>{{ $kibd->nama_m_barang }}</td>
                                      <td>{{ $kibd->harga_m_barang }}</td>
                                      <td>{{ $kibd->satuan_m_barang }}</td>
                                      <td class="text-center">
                                        <a href="barang/edit/{{ $kibd->id }}" class="btn btn-warning btn-icon-split">
                                          <span class="icon">
                                              <i class="fas fa-edit"></i>
                                          </span>
                                        </a>
                                        <a onclick="statusdelete({{ $kibd->id }})" class="btn btn-danger btn-icon-split">
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
                        <div class="tab-pane" id="kib-e">
                            <table id="data-kib-e" class="table table-responsive-md table-bordered table-hover">
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
                                  @foreach ($barangKIBE as $kibe)
                                    <tr>
                                      <td class="text-center">{{ $loop->iteration }}</td>
                                      <td>{{ $kibe->nama_m_barang }}</td>
                                      <td>{{ $kibe->harga_m_barang }}</td>
                                      <td>{{ $kibe->satuan_m_barang }}</td>
                                      <td class="text-center">
                                        <a href="barang/edit/{{ $kibe->id }}" class="btn btn-warning btn-icon-split">
                                          <span class="icon">
                                              <i class="fas fa-edit"></i>
                                          </span>
                                        </a>
                                        <a onclick="statusdelete({{ $kibe->id }})" class="btn btn-danger btn-icon-split">
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
                        <div class="tab-pane" id="kib-f">
                            <table id="data-kib-f" class="table table-responsive-md table-bordered table-hover">
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
                                  @foreach ($barangKIBF as $kibf)
                                    <tr>
                                      <td class="text-center">{{ $loop->iteration }}</td>
                                      <td>{{ $kibf->nama_m_barang }}</td>
                                      <td>{{ $kibf->harga_m_barang }}</td>
                                      <td>{{ $kibf->satuan_m_barang }}</td>
                                      <td class="text-center">
                                        <a href="barang/edit/{{ $kibf->id }}" class="btn btn-warning btn-icon-split">
                                          <span class="icon">
                                              <i class="fas fa-edit"></i>
                                          </span>
                                        </a>
                                        <a onclick="statusdelete({{ $kibf->id }})" class="btn btn-danger btn-icon-split">
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