<table class="table table-bordered">
    <tr>
        <th>Program Kerja</th>
        <td>
            @if ($work_program->work_program == 1)
                <span class="badge badge-success">{{ 'Teknologi Informasi' }}</span>
            @elseif($work_program->work_program == 2)
                <span class="badge badge-warning">{{ 'Hardware' }}</span>
            @elseif($work_program->work_program == 3)
                <span class="badge badge-secondary">{{ 'Jaringan' }}</span>
            @elseif($work_program->work_program == 4)
                <span class="badge badge-danger">{{ 'Peralatan Tol' }}</span>
            @elseif($work_program->work_program == 5)
                <span class="badge badge-info">{{ 'Sistem Informasi' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Tahun</th>
        <td>{{ isset($work_program->year) ? $work_program->year : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Umum</th>
        <td>{{ isset($work_program->general) ? $work_program->general : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Teknis</th>
        <td>{{ isset($work_program->technical) ? $work_program->technical : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Progress</th>
        <td>{{ isset($work_program->progress) ? $work_program->progress : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($work_program->status == 1)
                <span class="badge badge-success">{{ 'Aktif' }}</span>
            @elseif($work_program->status == 2)
                <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{!! isset($work_program->description) ? $work_program->description : 'N/A' !!}
        </td>
    </tr>
</table>
