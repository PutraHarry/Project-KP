@extends('layouts.master')
@section('title')
    Penerimaan
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
            <li class="breadcrumb-item active">Penerimaan</li>
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
                      <h3 class="card-title">List Data Penerimaan</h3>
                      <div class="card-tools">                          
                          <div class="col-md-12">
                            @if (in_array(auth()->guard('admin')->user()->jabatan->jabatan, ['PPBP']))
                              <a href="/penerimaan/create" class="btn btn-primary">
                                  <i class="fa fa-plus"></i> 
                                  Penerimaan Baru
                              </a>
                            @endif
                          </div>
                      </div>
                  </div>
                  <div class="card-body table-responsive-md">
                      <div class="row">
                        <div class="col-md-6 p-2">
                            <ul class="nav nav-pills d-flex justify-content-center justify-content-md-start">
                                <li class="nav-item"><a class="nav-link active" href="#tbobat" data-toggle="tab">Obat</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tbnon-obat" data-toggle="tab">Non Obat</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tbhibah" data-toggle="tab">Hibah</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tbnon-hibah" data-toggle="tab">Non Hibah</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tbnon-apbd" data-toggle="tab">Non APBD</a></li>
                            </ul>
                        </div>
                      </div>
                      <div class="tab-content">
                          <div class="active tab-pane" id="tbobat">
                              <table id="dataObat" class="table table-responsive-md table-bordered table-hover">
                                  <thead>
                                      <tr class="text-center">
                                        <th>No.</th>
                                        <th>Penerimaan Obat</th>
                                        <th>Kegiatan</th>
                                        <th>Diterima dari</th>
                                        <th>Tanggal Penerimaan</th>
                                        <th>Status</th>                                        
                                        <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($tpenerimaanObat as $tpo)
                                      <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $tpo->kode_penerimaan }}</td>
                                        <td>{{ $tpo->kegiatan->nama_kegiatan }}</td>
                                        <td>{{ $tpo->diterima_dari }}</td>
                                        <td>{{ $tpo->tgl_terima }}</td>
                                        <td>
                                          @if($tpo->status_penerimaan == "draft")
                                            <span class="badge badge-warning">Draft</span>
                                          @elseif($tpo->status_penerimaan != "draft")
                                            <span class="badge badge-primary">Final</span>                       
                                          @endif    
                                        </td>                                        
                                        <td class="text-center">
                                          <a href="/penerimaan/edit/{{ $tpo->id }}" class="btn btn-warning btn-icon-split">
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                          </a>
                                          @if ($tpo->status_penerimaan == 'draft')
                                            <a onclick="statusdelete({{ $tpo->id }})" class="btn btn-danger btn-icon-split">
                                                <span class="icon">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                              </a>
                                          @endif
                                        </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <div class="tab-pane" id="tbnon-obat">
                              <table id="dataNonObat" class="table table-responsive-md table-bordered table-hover">
                                  <thead>
                                      <tr class="text-center">
                                        <th>No.</th>
                                        <th>Penerimaan Non Obat</th>
                                        <th>Kegiatan</th>
                                        <th>Diterima dari</th>
                                        <th>Tanggal Penerimaan</th>
                                        <th>Status</th>                                        
                                        <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($tpenerimaanNonObat as $tpno)
                                      <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $tpno->kode_penerimaan }}</td>
                                        <td>{{ $tpno->kegiatan->nama_kegiatan }}</td>
                                        <td>{{ $tpno->diterima_dari }}</td>
                                        <td>{{ $tpno->tgl_terima }}</td>
                                        <td>
                                          @if($tpo->status_penerimaan == "draft")
                                            <span class="badge badge-warning">Draft</span>
                                          @elseif($tpo->status_penerimaan != "draft")
                                            <span class="badge badge-primary">Final</span>                       
                                          @endif  
                                        </td>                                        
                                        <td class="text-center">
                                          <a href="/penerimaan/edit/{{ $tpno->id }}" class="btn btn-warning btn-icon-split">
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                          </a>
                                          @if ($tpno->status_penerimaan == 'draft')
                                            <a onclick="statusdelete({{ $tpno->id }})" class="btn btn-danger btn-icon-split">
                                              <span class="icon">
                                                  <i class="fas fa-trash"></i>
                                              </span>
                                            </a>
                                          @endif
                                        </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <div class="tab-pane" id="tbhibah">
                              <table id="dataHibah" class="table table-responsive-md table-bordered table-hover">
                                  <thead>
                                      <tr class="text-center">
                                        <th>No.</th>
                                        <th>Penerimaan Hibah</th>
                                        <th>Kegiatan</th>
                                        <th>Diterima dari</th>
                                        <th>Tanggal Penerimaan</th>
                                        <th>Status</th>                                        
                                        <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($tpenerimaanHibah as $tph)
                                      <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $tph->kode_penerimaan }}</td>
                                        <td>{{ $tph->kegiatan->nama_kegiatan }}</td>
                                        <td>{{ $tph->diterima_dari }}</td>
                                        <td>{{ $tph->tgl_terima }}</td>
                                        <td>
                                          @if($tpo->status_penerimaan == "draft")
                                            <span class="badge badge-warning">Draft</span>
                                          @elseif($tpo->status_penerimaan != "draft")
                                            <span class="badge badge-primary">Final</span>                       
                                          @endif  
                                        </td>                                        
                                        <td class="text-center">
                                          <a href="/penerimaan/edit/{{ $tph->id }}" class="btn btn-warning btn-icon-split">
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                          </a>
                                          @if ($tph->status_penerimaan == 'draft')
                                            <a onclick="statusdelete({{ $tph->id }})" class="btn btn-danger btn-icon-split">
                                              <span class="icon">
                                                  <i class="fas fa-trash"></i>
                                              </span>
                                            </a>
                                          @endif
                                        </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>
                            <div class="tab-pane" id="tbnon-hibah">
                              <table id="dataNonHibah" class="table table-responsive-md table-bordered table-hover">
                                  <thead>
                                      <tr class="text-center">
                                        <th>No.</th>
                                        <th>Penerimaan Non Hibah</th>
                                        <th>Kegiatan</th>
                                        <th>Diterima dari</th>
                                        <th>Tanggal Penerimaan</th>
                                        <th>Status</th>                                        
                                        <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($tpenerimaanNonHibah as $tpnh)
                                      <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $tpnh->kode_penerimaan }}</td>
                                        <td>{{ $tpnh->kegiatan->nama_kegiatan }}</td>
                                        <td>{{ $tpnh->diterima_dari }}</td>
                                        <td>{{ $tpnh->tgl_terima }}</td>
                                        <td>
                                          @if($tpo->status_penerimaan == "draft")
                                            <span class="badge badge-warning">Draft</span>
                                          @elseif($tpo->status_penerimaan != "draft")
                                            <span class="badge badge-primary">Final</span>                       
                                          @endif   
                                        </td>
                                        <td class="text-center">
                                          <a href="/penerimaan/edit/{{ $tpnh->id }}" class="btn btn-warning btn-icon-split">
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                          </a>
                                          @if ($tpnh->status_penerimaan == 'draft')
                                            <a onclick="statusdelete({{ $tpnh->id }})" class="btn btn-danger btn-icon-split">
                                              <span class="icon">
                                                  <i class="fas fa-trash"></i>
                                              </span>
                                            </a>
                                          @endif
                                        </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <div class="tab-pane" id="tbnon-apbd">
                              <table id="dataNonAPBD" class="table table-responsive-md table-bordered table-hover">
                                  <thead>
                                      <tr class="text-center">
                                        <th>No.</th>
                                        <th>Penerimaan Non APBD</th>
                                        <th>Kegiatan</th>
                                        <th>Diterima dari</th>
                                        <th>Tanggal Penerimaan</th>
                                        <th>Status</th>                                        
                                        <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($tpenerimaanNonAPBD as $tpna)
                                      <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $tpna->kode_penerimaan }}</td>
                                        <td>{{ $tpna->kegiatan->nama_kegiatan }}</td>
                                        <td>{{ $tpna->diterima_dari }}</td>
                                        <td>{{ $tpna->tgl_terima }}</td>
                                        <td>{{ $tpna->pengirim }}</td>
                                        <td>
                                          @if($tpo->status_penerimaan == "draft")
                                            <span class="badge badge-warning">Draft</span>
                                          @elseif($tpo->status_penerimaan != "draft")
                                            <span class="badge badge-primary">Final</span>                       
                                          @endif  
                                        </td>                                       
                                        <td class="text-center">
                                          <a href="/penerimaan/edit/{{ $tpna->id }}" class="btn btn-warning btn-icon-split">
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                          </a>
                                          @if ($tpna->status_penerimaan == 'draft')
                                            <a onclick="statusdelete({{ $tpna->id }})" class="btn btn-danger btn-icon-split">
                                              <span class="icon">
                                                  <i class="fas fa-trash"></i>
                                              </span>
                                            </a>
                                          @endif
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
    $('#dataObat').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#dataNonObat').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#dataHibah').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#dataNonHibah').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#dataNonAPBD').DataTable({
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
  $("#sdelete").attr("action", "/penerimaan/delete/"+id);
  $('#modal-sdelete').modal('show');
  }
</script>    
@endpush