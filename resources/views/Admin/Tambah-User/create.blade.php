@extends('layouts.master')
@section('title')
Create User Baru
@endsection

@push('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="/adminlte/plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="/adminlte/plugins/dropzone/min/dropzone.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Persediaan Kab Badung</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/user">Kelola User</a></li>
              <li class="breadcrumb-item active">Tambah User Baru</li>
            </ol>
          </div>
        </div>
        <div>
            <a href="/user" class="btn btn-default btn-icon-split">
                <span class="icon">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
          </div>
      </div>
    </section>
      
    <!-- Main content -->
    <form action="/user/insert" method="POST">
      @csrf
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Input Data User Baru</h3>
                </div>

                <form id="quickForm">
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Input Username">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" >                              
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword">Masukkan Ulang Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Password" >
                            </div>
                            <div id="status_password"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama User</label>
                        <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Input Nama User">
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>Tanggal Lahir:</label>
                          <div class="input-group">
                          <input type="date" class="form-control" name="dob" id="dob">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>OPD</label>
                      <select class="select2" name="id_opd" id="id_opd" data-placeholder="Pilih OPD" style="width: 100%;">
                      @foreach ($dataOPD as $do)
                        <option value={{ $do->id }}>{{ $do->nama_opd }}</option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Unit Perangkat Daerah</label>
                      <select class="select2" name="id_unit" id="id_unit" data-placeholder="Pilih Unit Perangkat Daeerah" style="width: 100%;">
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jabatan</label>
                      <select class="select2" name="id_jabatan" id="id_jabatan" data-placeholder="Pilih Jabatan" style="width: 100%;">
                      @foreach ($jabatan as $jabatan)
                        <option value={{ $jabatan->id }}>{{ $jabatan->jabatan }}</option>
                      @endforeach
                      </select>
                    </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </section>
    </form>
@endsection

@push('js')

<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="/adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

    let id = $('#id_opd').val();
    $.ajax({
      type: 'GET',
      url: '/user/dataUnit/'+id,
      success: function (response){
        //console.log(response);
          $('#id_unit').empty();
          response.forEach(element => {
              $('#id_unit').append('<option value='+element.id+'>'+element.unit+'</option>');
          });
      }
    });

    $('#id_opd').change(function() {
      if($('#id_opd').val() != ""){ 
          let id = $(this).val();
          $.ajax({
              type: 'GET',
              url: '/user/dataUnit/'+id,
              success: function (response){
                //console.log(response);
                  $('#id_unit').empty();
                  response.forEach(element => {
                      $('#id_unit').append('<option value='+element.id+'>'+element.unit+'</option>');
                  });
              }
          });
      } 
    });

    
    $('#confirm_password').keyup(function(){
      let password = $('#password').val();
      let konfirm_password = $('#confirm_password').val();
      $('#status_password').empty();
      if(konfirm_password == password){
        $('#status_password').append('<a class="text-success">Password sama</a>');
      }
      if(konfirm_password != password){
        $('#status_password').append('<a class="text-danger">Password tidak sama</a>');
      }
    })

  })
</script>


@endpush