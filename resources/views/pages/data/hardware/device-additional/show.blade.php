<table class="table table-bordered">
    <tr>
        <th>No Non Asset</th>
        <td>
            <span
                class="badge badge-success">{{ isset($device_additional->no_non_asset) ? $device_additional->no_non_asset : 'N/A' }}</span>
        </td>
    </tr>
    <tr>
        <th>Perangkat</th>
        <td>{{ isset($device_additional->type_device->name) ? $device_additional->type_device->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Nama Perangkat</th>
        <td>{{ isset($device_additional->name) ? $device_additional->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Spesifikasi</th>
        <td>{{ isset($device_additional->specification) ? $device_additional->specification : 'N/A' }}</td>
    </tr>
    <tr>
        <th>File</th>
        <td> <a data-fancybox="gallery" data-src="{{ asset('storage/' . $device_additional->file) }}"
                class="blue accent-4 dropdown-item">Show</a></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($device_additional->status == 1)
                <span class="badge badge-info">{{ 'Ready to Deploy' }}</span>
            @elseif($device_additional->status == 2)
                <span class="badge badge-success">{{ 'Deploy' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{!! isset($device_additional->description) ? $device_additional->description : 'N/A' !!}</td>
    </tr>
</table>
