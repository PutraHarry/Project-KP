
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
    <tbody id="data">
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