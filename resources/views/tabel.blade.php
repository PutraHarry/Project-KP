@extends('layouts.master')

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
          
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Tabel</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tabel</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

      
          <!-- Main content -->
                <section class="content">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body">
                                <a href="/tabel/create" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <span class="text">Create Data</span>
                                </a>
                                <a href="#" class="btn btn-danger btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text">Delete Data</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th colspan="5"> Kegiatan</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th rowspan="2" class="align-middle">No</th>
                                            <th rowspan="2" class="align-middle">Uraian</th>
                                            <th colspan="3" class="align-middle">Saldo Awal</th>                                            
                                        </tr>
                                        <tr class="text-center">
                                            <th>KIB A</th>
                                            <th>KIB B</th>
                                            <th>KIB C</th>
                                        </tr>

                                    </thead>
                                    
                                    
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Jualan</td>
                                            <td>23000</td>
                                            <td>30000</td>
                                            <td>50000</td>
                                        </tr>
                                        

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-delete">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Delete Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <p>anda yakin akan menghapus data ini?</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a href="/tabel/delete/id" id="bdelete" type="button" class="btn btn-danger">Yes</a>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </section>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bordered Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="5"> Kegiatan</th>
                            </tr>
                            <tr class="text-center">
                                <th rowspan="2" class="align-middle">No</th>
                                <th rowspan="2" class="align-middle">Uraian</th>
                                <th colspan="3" class="align-middle">Saldo Awal</th>                                            
                            </tr>
                            <tr class="text-center">
                                <th>KIB A</th>
                                <th>KIB B</th>
                                <th>KIB C</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Jualan</td>
                                <td>23000</td>
                                <td>30000</td>
                                <td>50000</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5"> Kegiatan</th>
                            </tr>
                            <tr class="text-center">
                                <th rowspan="2" class="align-middle">No</th>
                                <th rowspan="2" class="align-middle">Uraian</th>
                                <th colspan="3" class="align-middle">Saldo Awal</th>                                            
                            </tr>
                            <tr class="text-center">
                                <th>KIB A</th>
                                <th>KIB B</th>
                                <th>KIB C</th>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>                                                                              
                </div>
                  <!-- /.card -->

                  <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Test Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <style>
                            table {border: 1px solid #000000;border-collapse: collapse; margin: 0 auto;  padding: 0px;table-layout: fixed;min-width: 100%;}table th {text-align: center;padding: 8px;border: 1px solid #000000;background:#1b90bb;color:#FFFFFF;font-weight:bold;text-align:center}table td{padding: 8px;border: 1px solid #000000;}table tr{background-color: #dddddd;color:#000000;text-align:center;}
                        </style>
                        <table>
                            <tr>
                                <th colspan='18' >SKPD : Badan Pengelola Keuangan dan Aset Daerah</th>
                            
                            </tr>
                            <tr>
                                <td rowspan='1' colspan='18' >Unit Kerja : Badan Pengelola Keuangan dan Aset Daerah</td>
                            </tr>
                            <tr>
                                <td rowspan='1' colspan='18' >Kode Kegiatan : 4.4.1.1.1.1 - Penyusunan Dokumen Perencanaan Perangkat Daerah</td>
                            </tr>
                            <tr>
                                <td rowspan='2' colspan='1' >No.</td>
                                <td rowspan='2' colspan='1' >Uraian</td>
                                <td rowspan='1' colspan='4' >Saldo Awal</td>
                                <td rowspan='1' colspan='4' >Masuk</td>
                                <td rowspan='1' colspan='4' >Keluar</td>
                                <td rowspan='1' colspan='4' >Sisa</td>
                            </tr>
                            <tr>
                                <td>Volume</td> <!--Saldo Awal punya-->>
                                <td>Satuan</td>
                                <td>Harga Satuan</td>
                                <td>Jumlah</td>
                                <td>Volume</td> <!--Masuk punya-->>
                                <td>Satuan</td>
                                <td>Harga Satuan</td>
                                <td>Jumlah</td>
                                <td>Volume</td> <!--Keluar punya-->>
                                <td>Satuan</td>
                                <td>Harga Satuan</td>
                                <td>Jumlah</td>
                                <td>Volume</td> <!--Sisa punya-->>
                                <td>Satuan</td>
                                <td>Harga Satuan</td>
                                <td>Jumlah</td>
                            </tr>
                            <tr>
                                <td rowspan='1' colspan='18' >Alat Tulis Kantor</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Binder Klip</td>
                                <td>0</td>
                                <td>Kotak</td>
                                <td>11.500,00</td>
                                <td>0,00</td>
                                <td>0</td>
                                <td>Kotak</td>
                                <td>11.500,00</td>
                                <td>0,00</td>
                                <td>0</td>
                                <td>Kotak</td>
                                <td>11.500,00</td>
                                <td>0,00</td>
                                <td>0</td>
                                <td>Kotak</td>
                                <td>11.500,00</td>
                                <td>0,00</td>
                            </tr>
                            <tr>
                                <td rowspan='1' colspan='2' >JUMLAH</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>0,00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>0,00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>0,00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>0,00</td>
                            </tr>
                            <tr>
                                <td rowspan='1' colspan='2' >Total Keseluruhan</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>0,00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>0,00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>0,00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>0,00</td>
                            </tr>
                        </table>                                                                            
                </div>
                    
@endsection
@push('js')
    <!-- Bootstrap core JavaScript-->
    <script src="/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/sbadmin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/sbadmin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sbadmin/js/demo/datatables-demo.js"></script>

    <script>
        function deletedata(id) {
            $("#bdelete").attr("href", "/tabel/delete/"+id);
            $('#modal-delete').modal('show');
            
        }
    </script>

    
                    

    
@endpush