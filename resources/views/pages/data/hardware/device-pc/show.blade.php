<table class="table table-bordered">
    <tr>
        <th>No Asset</th>
        <td>
            <span class="badge badge-success">{{ isset($device_pc->no_asset) ? $device_pc->no_asset : 'N/A' }}</span>
        </td>
    </tr>
    <tr>
        <th>Nama</th>
        <td>{{ isset($device_pc->name) ? $device_pc->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Motherboard</th>
        <td>{{ isset($device_pc->motherboard->name) ? $device_pc->motherboard->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Processor</th>
        <td>{{ isset($device_pc->processor->name) ? $device_pc->processor->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Hardisk</th>
        <td>
            @foreach (explode(',', $device_pc->hardisk_id) as $data_hardisk)
                @php
                    $spek_hardisk = DB::table('hardware_hardisk')
                        ->where('id', $data_hardisk)
                        ->get();
                @endphp
                @foreach ($spek_hardisk as $hardisk)
                    {{ $hardisk->name }} - {{ $hardisk->size }} ||
                @endforeach
            @endforeach
        </td>
    </tr>
    <tr>
        <th>Ram</th>
        <td>
            @foreach (explode(',', $device_pc->ram_id) as $data_ram)
                @php
                    $spek_ram = DB::table('hardware_ram')
                        ->where('id', $data_ram)
                        ->get();
                @endphp
                @foreach ($spek_ram as $ram)
                    {{ $ram->name }} - {{ $ram->size }} ||
                @endforeach
            @endforeach
        </td>
    </tr>
    <tr>
        <th>File</th>
        <td> <a data-fancybox="gallery" data-src="{{ asset('storage/' . $device_pc->file) }}"
                class="blue accent-4 dropdown-item">Show</a></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($device_pc->status == 1)
                <span class="badge badge-info">{{ 'Ready to Deploy' }}</span>
            @elseif($device_pc->status == 2)
                <span class="badge badge-success">{{ 'Deploy' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{!! isset($device_pc->description) ? $device_pc->description : 'N/A' !!}</td>
    </tr>
</table>

<table class="table table-bordered">
    <tr>
        <th>Port</th>
        <th>Ip Address</th>
        <th>Keterangan</th>
    </tr>
    @foreach ($ip_address as $ip_address_item)
        <tr>
            <td>{{ isset($ip_address_item->port) ? $ip_address_item->port : 'N/A' }}</td>
            <td>{{ isset($ip_address_item->ip_address) ? $ip_address_item->ip_address : 'N/A' }}</td>
            <td>{{ isset($ip_address_item->keterangan) ? $ip_address_item->keterangan : 'N/A' }}</td>
        </tr>
    @endforeach
</table>

<table class="table table-bordered">
    <tr>
        <th align="center">Tgl kerusakan</th>
        <th align="center">Keterangan</th>
    </tr>
    @foreach ($troubleshoot_pc as $troubleshoot_pc_item)
        <tr>
            <td>{{ isset($troubleshoot_pc_item->tgl_perbaikan) ? Carbon\Carbon::parse($troubleshoot_pc_item->tgl_perbaikan)->translatedFormat('l, d F Y') : 'N/A' }}
            <td>{{ isset($troubleshoot_pc_item->description) ? $troubleshoot_pc_item->description : 'N/A' }}</td>
        </tr>
    @endforeach
</table>
