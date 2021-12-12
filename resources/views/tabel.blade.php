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
                      <div class="modal-footer justify-content-between">
                        <button class="btn btn-success" id="btn">Simpan</button>
                      </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
                        </div>
                    </div>
                </section>

                <section class="content" id="test">
                  
                </section>
                    

                    
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
      $('#btn').click(function() {
        // var id = $(this).val();
        // var id = $(this).val();
        // var id = $(this).val();
          $.ajax({
            type: 'GET',
            url: '/tabel/getDataTabel',
            success: function (response){
              // console.log(response);
              $('#test').append(
                '<div class="card card-default">' +
                  '<div class="card-body">' +
                    '<div class="row">' +
                      '<div class="table-responsive">' +
                        '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">' +
                          '<thead>' +
                            '<tr>' +
                              '<th colspan="5"> Kegiatan</th>' +
                            '</tr>' +
                            '<tr class="text-center">' +
                              '<th rowspan="2" class="align-middle">No</th>' +
                              '<th rowspan="2" class="align-middle">Uraian</th>' +
                              '<th colspan="3" class="align-middle">Saldo Awal</th>' +                                            
                            '</tr>' +
                            '<tr class="text-center">' +
                              '<th>KIB A</th>' +
                              '<th>KIB B</th>' +
                              '<th>KIB C</th>' +
                            '</tr>' +
                          '</thead>' +
                          '<tbody>' +
                            '<tr>' +
                              '<td>1</td>' +
                              '<td>Jualan</td>' +
                              '<td>23000</td>' +
                              '<td>30000</td>' +
                              '<td>50000</td>' +
                            '</tr>' +
                          '</tbody>' +
                        '</table>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>'
              );
            }
          });
      });
    </script>

    
                    

    
@endpush