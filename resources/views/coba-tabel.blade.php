<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table border="1" id="dataTable" width="100%" cellspacing="0">
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
                        @foreach ($coba as $barang)
                            <tr>
                                <td>1</td>
                                <td>Binder Klip</td>
                                <td>0</td>
                                <td id="satuan"></td>
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
                        @endforeach
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    var barang = {!! json_encode($coba->toArray()) !!}
    var DetailPenerimaan = {!! json_encode($coba->toArray()) !!}
    // console.log(nama_barang);
    nama_barang.forEach(element1 => {
        DetailPenerimaan.forEach(element2 => {
            if(element2.id_barang == element1.id){
                $('#satuan').append('kotak');
            }
        });
    });
</script>