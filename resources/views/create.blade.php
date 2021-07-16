@extends('layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
          <!-- col card-body -->
        <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Data</h3>
              </div><!-- /.card-header -->
                    <form action="/tabel/insert" method="POST">  
                    @csrf
                        <div class="card-body">     
                            <div class="row">
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama Data</label>
                                        <input name="nama" class="form-control" placeholder="Datanya" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Keterangan Data</label>
                                        <input name="keterangan" class="form-control" placeholder="Keterangan Datanya" required>
                                    </div>
                                </div>


                                
                            </div>
                            

                            <!-- /.card-body -->
                        </div>
                            <!--card-footer-->
                            <div class="card-footer">
                                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
                                    <a href="/tabel"><button type="button" class="btn btn-default float-right">Cancel</button></a>
                            </div><!-- /.card-footer -->
                    </form>
            </div>
        </div><!-- /.col -->
    </section>
    <!-- /.content -->

@endsection