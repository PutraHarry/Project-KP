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
                                            <th width="40px" class="text-center">No.</th>
                                            <th>Name</th>
                                            <th>Keterangan</th>
                                            <th width="100px" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tfoot>
                                        <tr>
                                            <th width="40px" class="text-center">No.</th>
                                            <th>Name</th>
                                            <th>Keterangan</th>
                                            <th width="100px" class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($Total as $test)
                                        <tr>
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td>{{$test->nama}}</td>
                                            <td>{{$test->keterangan}}</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="/tabel/edit/{{$test->id}}" class="btn btn-warning"><i class="fas fa-edit"></i><a>
                                                    <button class="btn btn-sm btn-flat btn-danger" onclick="deletedata({{$test->id}})"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach


                                        
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