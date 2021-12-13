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
                    {{-- <tr>
                        <th rowspan='1' colspan='18' >Kode Kegiatan : 4.4.1.1.1.1 - Penyusunan Dokumen Perencanaan Perangkat Daerah</th>
                    </tr> --}}
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
                                <td>{{ $loop->iteration }}</td>
                                <td id="namaSaldoAwal{{ $barang->id }}"></td>
                                <td id="volumeSaldoAwal{{ $barang->id }}"></td>
                                <td id="satuanSaldoAwal{{ $barang->id }}"></td>
                                <td id="hargaSaldoAwal{{ $barang->id }}"></td>
                                <td id="totalSaldoAwal{{ $barang->id }}"></td>
                                <td id="volumePenerimaan{{ $barang->id }}"></td>
                                <td id="satuanPenerimaan{{ $barang->id }}"></td>
                                <td id="hargaPenerimaan{{ $barang->id }}"></td>
                                <td id="totalPenerimaan{{ $barang->id }}"></td>
                                <td id="volumePengeluaran{{ $barang->id }}"></td>
                                <td id="satuanPengeluaran{{ $barang->id }}"></td>
                                <td id="hargaPengeluaran{{ $barang->id }}"></td>
                                <td id="totalPengeluaran{{ $barang->id }}"></td>
                                <td id="volumeSisa{{ $barang->id }}"></td>
                                <td id="satuanSisa{{ $barang->id }}"></td>
                                <td id="hargaSisa{{ $barang->id }}"></td>
                                <td id="totalSisa{{ $barang->id }}"></td>
                            </tr>
                        @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th rowspan='1' colspan='2' >JUMLAH</th>
                        <td colspan='3'></td>
                        <td id="jumlahTotalSaldoAwal"></td>
                        <td colspan='3'></td>
                        <td id="jumlahTotalPenerimaan"></td>
                        <td colspan='3'></td>
                        <td id="jumlahTotalPengeluaran"></td>
                        <td colspan='3'></td>
                        <td id="jumlahTotalSisa"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>                                                                       
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    var barang = {!! json_encode($coba->toArray()) !!}
    let count = 0;
    let hargaSaldoAwal = 0;
    let hargaPenerimaan = 0;
    let hargaPengeluaran = 0;
    let hargaSisa = 0;
    // console.log(barang);
    // console.log(BarangUnit);
    // console.log(SaldoAwal);
    barang.forEach(element1 => {
        $('#namaSaldoAwal'+element1.id).append(element1.nama_m_barang);
        $.ajax({
            type: 'GET',
            url: '/coba1/'+element1.id,
            success: function (response){
                //console.log(count);
                $('#volumeSaldoAwal'+element1.id).append(response.jumlahBarang);
                $('#satuanSaldoAwal'+element1.id).append(element1.satuan_m_barang);
                $('#hargaSaldoAwal'+element1.id).append(element1.harga_m_barang);
                if(response.dataBarang != null){
                    $('#totalSaldoAwal'+element1.id).append(response.totalHarga);
                    hargaSaldoAwal = hargaSaldoAwal + response.totalHarga;
                    // console.log(hargaSaldoAwal);
                    $('#jumlahTotalSaldoAwal').empty();
                    $('#jumlahTotalSaldoAwal').append(hargaSaldoAwal);
                } else{
                    $('#totalSaldoAwal'+element1.id).append('0');
                    hargaSaldoAwal = hargaSaldoAwal + 0;
                    // console.log(hargaSaldoAwal);
                    $('#jumlahTotalSaldoAwal').empty();
                    $('#jumlahTotalSaldoAwal').append(hargaSaldoAwal);
                }
            }
        });

        $.ajax({
            type: 'GET',
            url: '/coba2/'+element1.id,
            success: function (response){
                // console.log(response.dataBarang);
                $('#volumePenerimaan'+element1.id).append(response.jumlahBarang);
                $('#satuanPenerimaan'+element1.id).append(element1.satuan_m_barang);
                $('#hargaPenerimaan'+element1.id).append(element1.harga_m_barang);
                if(response.dataBarang != null){
                    $('#totalPenerimaan'+element1.id).append(response.totalHarga);
                    hargaPenerimaan = hargaPenerimaan + response.totalHarga;
                    // console.log(hargaSaldoAwal);
                    $('#jumlahTotalPenerimaan').empty();
                    $('#jumlahTotalPenerimaan').append(hargaPenerimaan);
                } else{
                    $('#totalPenerimaan'+element1.id).append('0');
                    hargaPenerimaan = hargaPenerimaan + 0;
                    // console.log(hargaSaldoAwal);
                    $('#jumlahTotalPenerimaan').empty();
                    $('#jumlahTotalPenerimaan').append(hargaPenerimaan);
                }
            }
        });
        
        $.ajax({
            type: 'GET',
            url: '/coba3/'+element1.id,
            success: function (response){
                // console.log(response.dataBarang);
                $('#volumePengeluaran'+element1.id).append(response.jumlahBarang);
                $('#satuanPengeluaran'+element1.id).append(element1.satuan_m_barang);
                $('#hargaPengeluaran'+element1.id).append(element1.harga_m_barang);
                if(response.dataBarang != null){
                    $('#totalPengeluaran'+element1.id).append(response.totalHarga);
                    hargaPengeluaran = hargaPengeluaran + response.totalHarga;
                    // console.log(hargaSaldoAwal);
                    $('#jumlahTotalPengeluaran').empty();
                    $('#jumlahTotalPengeluaran').append(hargaPengeluaran);
                } else{
                    $('#totalPengeluaran'+element1.id).append('0');
                    hargaPengeluaran = hargaPengeluaran + 0;
                    // console.log(hargaSaldoAwal);
                    $('#jumlahTotalPengeluaran').empty();
                    $('#jumlahTotalPengeluaran').append(hargaPengeluaran);
                }
            }
        });
        
        $.ajax({
            type: 'GET',
            url: '/coba4/'+element1.id,
            success: function (response){
                // console.log(response.dataBarang);
                $('#volumeSisa'+element1.id).append(response.dataBarang.qty);
                $('#satuanSisa'+element1.id).append(element1.satuan_m_barang);
                $('#hargaSisa'+element1.id).append(element1.harga_m_barang);
                if(response.dataBarang != null){
                    $('#totalSisa'+element1.id).append(response.totalHarga);
                    hargaSisa = hargaSisa + response.totalHarga;
                    // console.log(hargaSaldoAwal);
                    $('#jumlahTotalSisa').empty();
                    $('#jumlahTotalSisa').append(hargaSisa);
                } else{
                    $('#totalSisa'+element1.id).append('0');
                    hargaSisa = hargaSisa + 0;
                    // console.log(hargaSaldoAwal);
                    $('#jumlahTotalSisa').empty();
                    $('#jumlahTotalSisa').append(hargaSisa);
                }
            }
        });

    });

    
</script>

{{-- <script>
    var barang = {!! json_encode($coba->toArray()) !!}

    barang.forEach(element2 => {
        let hargaSaldoAwal = 0;

        let test = $('#totalSaldoAwal'+element2.id).val();
        console.log(test);

        hargaSaldoAwal = hargaSaldoAwal + $('#totalSaldoAwal'+element2.id).val();
        // console.log(hargaSaldoAwal);
    });
</script> --}}