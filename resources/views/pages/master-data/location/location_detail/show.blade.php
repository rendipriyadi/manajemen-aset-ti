<table class="table table-bordered">
    <tr>
        <th>Lokasi</th>
        <td>{{ isset($location_detail->location->name) ? $location_detail->location->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Sub Lokasi</th>
        <td>{{ isset($location_detail->location_sub->name) ? $location_detail->location_sub->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Ruangan</th>
        <td>{{ isset($location_detail->location_room->name) ? $location_detail->location_room->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{!! isset($location_detail->keterangan) ? $location_detail->keterangan : 'N/A' !!}
        </td>
    </tr>
</table>
