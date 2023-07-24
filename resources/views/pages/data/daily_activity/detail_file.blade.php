@foreach ($datafile as $file)
    <tr>
        <th>File</th>
        <td style="text-align:center;">
            {{ pathinfo($file->file, PATHINFO_FILENAME) }}
        </td>
        <td style="text-align:center;">
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Action</button>
            <div class="dropdown-menu">
                <a data-fancybox="gallery" data-src="{{ asset('storage/' . $file->file) }}"
                    class="blue accent-4 dropdown-item">Show</a>
                <a href="{{ asset('storage/' . $file->file) }}" class="dropdown-item" download>Download</a>
                <form action="{{ route('backsite.daily_activity.hapus_file', $file->id) }}" method="POST"
                    onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="dropdown-item" value="Delete">
                </form>
            </div>
        </td>
    </tr>
@endforeach
