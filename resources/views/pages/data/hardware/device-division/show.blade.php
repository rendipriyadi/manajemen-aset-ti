<table class="table table-bordered">
    <tr>
        <th>Divisi</th>
        <td>{{ $device_division->division->name ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Perangkat Tambahan</th>
        <td>
            @foreach (explode(',', $device_division->device_more_id) as $data_more)
                @php
                    $spek_more = DB::table('device_more')
                        ->join('hardware_type_device', 'device_more.type_device_id', '=', 'hardware_type_device.id')
                        ->select('device_more.*', 'hardware_type_device.name as name_type_device')
                        ->where('device_more.id', $data_more)
                        ->get();
                @endphp
                @foreach ($spek_more as $more)
                    <span class="badge badge-success">{{ $more->no_asset ?? 'N/A' }}</span>
                    - {{ $more->name_type_device ?? 'N/A' }} - {{ $more->name ?? 'N/A ?>' }} ||
                @endforeach
            @endforeach
        </td>
    </tr>
    <tr>
        <th>Lokasi</th>
        <td>
            {{ $device_division->location_detail->location_room->name ?? 'N/A' }} -
            {{ $device_division->location_detail->location_sub->name ?? 'N/A' }} -
            {{ $device_division->location_detail->location->name ?? 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>File</th>
        <td> <a data-fancybox="gallery" data-src="{{ asset('storage/' . $device_division->file) }}"
                class="blue accent-4 dropdown-item">Show</a></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($device_division->status == 1)
                <span class="badge badge-info">{{ 'Aktif' }}</span>
            @elseif($device_division->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Tanggal Deploy</th>
        <td>
            {{ Carbon\Carbon::parse($device_division->tgl_deploy)->translatedFormat('l, d F Y') }}
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{!! isset($device_division->description) ? $device_division->description : 'N/A' !!}</td>
    </tr>
</table>
