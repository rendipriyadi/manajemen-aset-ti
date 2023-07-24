<table class="table table-bordered">
    <input type="hidden" name="id" id="id" value="{{ $daily_activity->id }}">
    <tr>
        <th>Pelaksana</th>
        <td>{{ isset($daily_activity->detail_user->user->name) ? $daily_activity->detail_user->user->name : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Pendamping</th>
        <td>{{ isset($daily_activity->users->name) ? $daily_activity->users->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Tanggal Mulai</th>
        <td>{{ isset($daily_activity->start_date) ? Carbon\Carbon::parse($daily_activity->start_date)->translatedFormat('l, d F Y H:i') : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Kategori Pekerjaan</th>
        <td>{{ isset($daily_activity->work_category->name) ? $daily_activity->work_category->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Jenis Pekerjaan</th>
        <td>{{ isset($daily_activity->work_type->name) ? $daily_activity->work_type->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Kegiatan</th>
        <td>{!! isset($daily_activity->activity) ? $daily_activity->activity : 'N/A' !!}</td>
    </tr>
    <tr>
        <th>Lokasi</th>
        <td>{{ isset($daily_activity->location_room->name) ? $daily_activity->location_room->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Tanggal Selesai</th>
        <td>{{ isset($daily_activity->finish_date) ? Carbon\Carbon::parse($daily_activity->finish_date)->translatedFormat('l, d F Y H:i') : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Catatan</th>
        <td>{!! isset($daily_activity->description) ? $daily_activity->description : 'N/A' !!}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($daily_activity->status == 1)
                <span class="badge badge-success">{{ 'Aktif' }}</span>
            @elseif($daily_activity->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
</table>
<table class="table table-bordered tampildata">
</table>

<script>
    function tampilDataFile() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let id = $('#id').val();
        $.ajax({
            type: "post",
            url: "{{ route('backsite.daily_activity.show_file') }}",
            data: {
                id: id
            },
            dataType: "json",
            beforeSend: function() {
                $('.tampildata').html('<i class="bx bx-balloon bx-flasing"></i>');
            },
            success: function(response) {
                if (response.data) {
                    $('.tampildata').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function() {
        tampilDataFile();
    });
</script>
