<table class="table table-bordered">
    <input type="hidden" name="id" id="id" value="{{ $software->id }}">
    <tr>
        <th>Nama Software</th>
        <td>{{ isset($software->software_name) ? $software->software_name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Kategori Software</th>
        <td>{{ isset($software->software_category) ? $software->software_category : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Serial Number</th>
        <td>{{ isset($software->serial_number) ? $software->serial_number : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Jumlah Lisensi</th>
        <td>{{ isset($software->license_amount) ? $software->license_amount : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Awal Lisensi</th>
        <td>{{ isset($software->start_license) ? Carbon\Carbon::parse($software->start_license)->translatedFormat('l, d F Y') : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Akhir Lisensi</th>
        <td>{{ isset($software->finish_license) ? Carbon\Carbon::parse($software->finish_license)->translatedFormat('l, d F Y') : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>No PP</th>
        <td>{{ isset($software->no_pp) ? $software->no_pp : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Tipe Lisensi</th>
        <td>{{ isset($software->license_type) ? $software->license_type : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Tahun Pembelian</th>
        <td>{{ isset($software->purchase_year) ? $software->purchase_year : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($software->status == 1)
                <span class="badge badge-success">{{ 'Aktif' }}</span>
            @elseif($software->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{!! isset($software->description) ? $software->description : 'N/A' !!}</td>
    </tr>
</table>
