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
                

                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan='18' >SKPD : Badan Pengelola Keuangan dan Aset Daerah</th>
                                    </tr>
                                    <tr>
                                        <th rowspan='1' colspan='18' >Unit Kerja : Badan Pengelola Keuangan dan Aset Daerah</th>
                                    </tr>
                                    <tr>
                                        <th rowspan='1' colspan='18' >Kode Kegiatan : 4.4.1.1.1.1 - Penyusunan Dokumen Perencanaan Perangkat Daerah</th>
                                    </tr>
                                    <tr>
                                        <th rowspan='2' colspan='1' >No.</th>
                                        <th rowspan='2' colspan='1' >Uraian</th>
                                        <th rowspan='1' colspan='4' class="text-center">Saldo Awal</th>
                                        <th rowspan='1' colspan='4' class="text-center">Masuk</th>
                                        <th rowspan='1' colspan='4' class="text-center">Keluar</th>
                                        <th rowspan='1' colspan='4' class="text-center">Sisa</th>
                                    </tr>
                                    <tr>
                                        <th>Volume</th> <!--Saldo Awal punya-->
                                        <th>Satuan</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Volume</th> <!--Masuk punya-->
                                        <th>Satuan</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Volume</th> <!--Keluar punya-->
                                        <th>Satuan</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Volume</th> <!--Sisa punya-->
                                        <th>Satuan</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                    <tr>
                                        <th rowspan='1' colspan='18' >Alat Tulis Kantor</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th rowspan='1' colspan='2' >JUMLAH</th>
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
                                        <th rowspan='1' colspan='2' >Total Keseluruhan</th>
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
                                </tfoot>
                            </table>
                        </div>
                    </div>                                                                       
                </div>
                  <!-- /.card -->
                    
@endsection
@push('js')
    <!-- Bootstrap core JavaScript-->
    <script src="/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/sbadmin/js/sb-admin-2.min.js"></script>

    <script>
        
    </script>
@endpush