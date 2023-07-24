<table class="table table-bordered">
    <tr>
        <th>No Asset</th>
        <td>
            <span
                class="badge badge-success">{{ isset($device_monitor->no_asset) ? $device_monitor->no_asset : 'N/A' }}</span>
        </td>
    </tr>
    <tr>
        <th>Monitor</th>
        <td>{{ isset($device_monitor->name) ? $device_monitor->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Ukuran</th>
        <td>{{ isset($device_monitor->size) ? $device_monitor->size : 'N/A' }}</td>
    </tr>
    <tr>
        <th>File</th>
        <td> <a data-fancybox="gallery" data-src="{{ asset('storage/' . $device_monitor->file) }}"
                class="blue accent-4 dropdown-item">Show</a></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($device_monitor->status == 1)
                <span class="badge badge-info">{{ 'Ready to Deploy' }}</span>
            @elseif($device_monitor->status == 2)
                <span class="badge badge-success">{{ 'Deploy' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{!! isset($device_monitor->description) ? $device_monitor->description : 'N/A' !!}</td>
    </tr>
</table>
