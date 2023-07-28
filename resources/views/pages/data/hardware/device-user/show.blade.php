<table class="table table-bordered">
    <tr>
        <th>User</th>
        <td>{{ $device_user->employee->nip ?? 'N/A' }} - {{ $device_user->employee->name ?? 'N/A' }} -
            {{ $device_user->employee->division->name ?? 'N/A' }} </td>
    </tr>
    <tr>
        <th>PC</th>
        <td>
            <table class="table table-bordered">
                <tr>
                    <th>Nama PC</th>
                    <td>{{ $device_user->device_pc->name ?? 'N/A' }} </td>
                </tr>
                <tr>
                    <th>Processor</th>
                    <td>{{ $device_user->device_pc->processor->name ?? 'N/A' }} </td>
                </tr>
                <tr>
                    <th>Motherboard</th>
                    <td>{{ $device_user->device_pc->motherboard->name ?? 'N/A' }} </td>
                </tr>
                <th>Hardisk</th>
                <td>
                    @foreach (explode(',', $device_user->device_pc->hardisk_id) as $data_hardisk)
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
                <tr>
                    <th>Ram</th>
                    <td>
                        @foreach (explode(',', $device_user->device_pc->ram_id) as $data_ram)
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
            </table>
        </td>
    </tr>
    <tr>
        <th>Monitor</th>
        <td>
            @foreach (explode(',', $device_user->device_monitor_id) as $data_monitor)
                @php
                    $spek_monitor = DB::table('device_monitor')
                        ->where('id', $data_monitor)
                        ->get();
                @endphp
                @foreach ($spek_monitor as $monitor)
                    <span class="badge badge-success">{{ $monitor->no_asset ?? 'N/A' }}</span> -
                    {{ $monitor->name ?? 'N/A ?>' }} -
                    {{ $monitor->size ?? 'N/A' }} ||
                @endforeach
            @endforeach
        </td>
    </tr>
    <tr>
        <th>Aksesoris</th>
        <td>
            @foreach (explode(',', $device_user->device_additional_id) as $data_additional)
                @php
                    $spek_additional = DB::table('device_additional')
                        ->join('hardware_type_device', 'device_additional.type_device_id', '=', 'hardware_type_device.id')
                        ->select('device_additional.*', 'hardware_type_device.name as name_type_device')
                        ->where('device_additional.id', $data_additional)
                        ->get();
                @endphp
                @foreach ($spek_additional as $additional)
                    <span class="badge badge-success">{{ $additional->no_non_asset ?? 'N/A' }}</span>
                    - {{ $additional->name_type_device ?? 'N/A ?>' }} - {{ $additional->name ?? 'N/A' }} ||
                @endforeach
            @endforeach
        </td>
    </tr>
    <tr>
        <th>Perangkat Tambahan</th>
        <td>
            @foreach (explode(',', $device_user->device_more_id) as $data_more)
                @php
                    $spek_more = DB::table('device_more')
                        ->join('hardware_type_device', 'device_more.type_device_id', '=', 'hardware_type_device.id')
                        ->select('device_more.*', 'hardware_type_device.name as name_type_device')
                        ->where('device_more.id', $data_more)
                        ->get();
                @endphp
                @foreach ($spek_more as $more)
                    <span class="badge badge-success">{{ $more->no_asset ?? 'N/A' }}</span>
                    - {{ $more->name_type_device ?? 'N/A' }} - {{ $more->name ?? 'N/A' }} ||
                @endforeach
            @endforeach
        </td>
    </tr>
    <tr>
        <th>Software</th>
        <td>
            @foreach (explode(',', $device_user->software_id) as $data_software)
                @php
                    $spek_software = DB::table('software')
                        ->where('id', $data_software)
                        ->get();
                @endphp
                @foreach ($spek_software as $software)
                    {{ $software->software_category }} -
                    {{ $software->software_name }}
                @endforeach
            @endforeach
        </td>
    </tr>
    <tr>
        <th>Lokasi</th>
        <td>
            {{ $device_user->location->name ?? 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>File</th>
        <td> <a data-fancybox="gallery" data-src="{{ asset('storage/' . $device_user->file) }}"
                class="blue accent-4 dropdown-item">Show</a></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($device_user->status == 1)
                <span class="badge badge-info">{{ 'Aktif' }}</span>
            @elseif($device_user->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Tanggal Deploy</th>
        <td>
            {{ Carbon\Carbon::parse($device_user->tgl_deploy)->translatedFormat('l, d F Y') }}
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{!! isset($device_user->description) ? $device_user->description : 'N/A' !!}</td>
    </tr>
</table>
