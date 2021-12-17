<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr class="text-center">
          <th>No.</th>
          <th>Kode Pemusnahan</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($tpemusnahan as $tp)
        <tr>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td>{{ $tp->kode_pemusnahan }}</td>
          <td>{{ $tp->tgl_pemusnahan }}</td>
          <td>
            @if($tp->status_pemusnahan == "draft")
              <span class="badge badge-warning">Draft</span>
            @elseif($tp->status_pemusnahan == "final")
              <span class="badge badge-primary">Final</span>
            @endif
          </td>
          <td>{{ $tp->ket_pemusnahan }}</td>
          <td class="text-center">
              <a href="/pemusnahan/edit/{{ $tp->id }}" class="btn btn-warning btn-icon-split">
                <span class="icon">
                    <i class="fas fa-edit"></i>
                </span>
              </a>
              @if ($tp->status_pemusnahan == 'draft')
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