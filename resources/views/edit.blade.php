<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th colspan="5"> Kegiatan</th>
            </tr>
        
            {{-- <tr class="text-center">
                <th rowspan="2" class="align-middle">No</th>
                <th rowspan="2" class="align-middle">Uraian</th>
                <th colspan="3" class="align-middle">Saldo Awal</th>                                            
            </tr>
            <tr class="text-center">
                <th>KIB A</th>
                <th>KIB B</th>
                <th>KIB C</th>
            </tr> --}}
        </thead>
        
        
        <tbody>
        @foreach ($test as $test)
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

            <tr>
                <td>1</td>
                <td>{{ $test->id_barang }}</td>
                <td>{{ $test->qty }}</td>
                <td>30000</td>
                <td>50000</td>
            </tr>
        @endforeach
            
        </tbody>
    </table>
</div>