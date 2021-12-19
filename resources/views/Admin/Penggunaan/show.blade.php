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
<<<<<<< Updated upstream
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
                            <option>Placeholder Belum diproses</option>
                            <option>Placeholder Semua</option>
                            <option>Placeholder Sudah diproses</option>
                          </select>
                        </div>
                      </div>
                    </div>
                </form>
=======
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
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                      <thead>
                          <tr class="text-center">
                            <th>No.</th>
                            <th>Kode Penggunaan</th>
                            <th>Lokasi Gudang</th>
                            <th>Lokasi Tujuan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($tpenggunaan as $tp)
                          <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $tp->kode_penggunaan}}</td>
                            <td>{{ $tp->opd->nama_opd }}</td>
                            <td>{{ $tp->unit->unit }}</td>
                            <td>{{ $tp->tgl_penggunaan }}</td>
                            <td>
                              @if($tp->status_penggunaan == "draft")
                                <span class="badge badge-warning">Draft</span>
                              @elseif($tp->status_penggunaan == "final")
                                <span class="badge badge-primary">Final</span>
                              @elseif($tp->status_penggunaan == "approved")
                                <span class="badge badge-success">Approved</span>
                              @elseif($tp->status_penggunaan == "disetujui_ppbp")
                                <span class="badge badge-info">Disetujui PPBP</span>
                              @elseif($tp->status_penggunaan == "disetujui_atasanLangsung")
                                <span class="badge badge-secondary">Disetujui Atasan Langsung</span>
                              @endif
                            </td>
                            <td class="text-center">
                                <a href="/penggunaan/edit/{{ $tp->id }}" class="btn btn-warning btn-icon-split">
                                  <span class="icon">
                                      <i class="fas fa-edit"></i>
                                  </span>
                                </a>
                                @if ($tp->status_penggunaan == 'draft')
                                  <a onclick="statusdelete({{ $tp->id }})" class="btn btn-danger btn-icon-split">
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
>>>>>>> Stashed changes
              </div>
            </div>
          </div>
        </div>
<<<<<<< Updated upstream
      </div>
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
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                          <th>No.</th>
                          <th>Kode Penggunaan</th>
                          <th>Lokasi Gudang</th>
                          <th>Lokasi Tujuan</th>
                          <th>Tanggal</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($tpenggunaan as $tp)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $tp->kode_penggunaan}}</td>
                          <td>{{ $tp->gudangOPD->nama_gudang }}</td>
                          <td>{{ $tp->gudangUnit->nama_gudang }}</td>
                          <td>{{ $tp->tgl_penggunaan }}</td>
                          <td>
                            @if($tp->status_penggunaan == "draft")
                              <span class="badge badge-warning">Draft</span>
                            @elseif($tp->status_penggunaan == "final")
                              <span class="badge badge-primary">Final</span>
                            @elseif($tp->status_penggunaan == "approved")
                              <span class="badge badge-success">Disetujui KASI</span>
                            @elseif($tp->status_penggunaan == "disetujui_ppbp")
                              <span class="badge badge-info">Disetujui PPBP</span>
                            @elseif($tp->status_penggunaan == "disetujui_atasanLangsung")
                              <span class="badge badge-secondary">Disetujui Atasan Langsung</span>
                            @endif
                          </td>
                          <td class="text-center">
                              <a href="/penggunaan/edit/{{ $tp->id }}" class="btn btn-warning btn-icon-split">
                                <span class="icon">
                                    <i class="fas fa-edit"></i>
                                </span>
                              </a>
                              @if ($tp->status_penggunaan == 'draft')
                                <a onclick="statusdelete({{ $tp->id }})" class="btn btn-danger btn-icon-split">
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
=======
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
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'
})

=======
>>>>>>> Stashed changes
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
  function statusdelete(id) {
  $("#sdelete").attr("action", "/penggunaan/delete/"+id);
  $('#modal-sdelete').modal('show');
  }
</script>
@endpush