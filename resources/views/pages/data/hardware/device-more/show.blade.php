<table class="table table-bordered">
    <tr>
        <th>No Asset</th>
        <td>
            <span class="badge badge-success">{{ isset($device_more->no_asset) ? $device_more->no_asset : 'N/A' }}</span>
        </td>
    </tr>
    <tr>
        <th>Perangkat</th>
        <td>{{ isset($device_more->type_device->name) ? $device_more->type_device->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Nama Perangkat</th>
        <td>{{ isset($device_more->name) ? $device_more->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Spesifikasi</th>
        <td>{{ isset($device_more->specification) ? $device_more->specification : 'N/A' }}</td>
    </tr>
    <tr>
        <th>File</th>
        <td> <a data-fancybox="gallery" data-src="{{ asset('storage/' . $device_more->file) }}"
                class="blue accent-4 dropdown-item">Show</a></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($device_more->status == 1)
                <span class="badge badge-info">{{ 'Ready to Deploy' }}</span>
            @elseif($device_more->status == 2)
                <span class="badge badge-success">{{ 'Deploy' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{!! isset($device_more->description) ? $device_more->description : 'N/A' !!}</td>
    </tr>
</table>

<table class="table table-bordered">
    <tr>
        <th align="center">Tgl kerusakan</th>
        <th align="center">Keterangan</th>
    </tr>
    @foreach ($troubleshoot_device_more as $troubleshoot_device_more_item)
        <tr>
            <td>{{ isset($troubleshoot_device_more_item->tgl_perbaikan) ? Carbon\Carbon::parse($troubleshoot_device_more_item->tgl_perbaikan)->translatedFormat('l, d F Y') : 'N/A' }}
            <td>{{ isset($troubleshoot_device_more_item->description) ? $troubleshoot_device_more_item->description : 'N/A' }}
            </td>
        </tr>
    @endforeach
</table>
