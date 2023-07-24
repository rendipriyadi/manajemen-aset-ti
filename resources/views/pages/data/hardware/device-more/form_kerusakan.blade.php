<div class="modal fade" id="modalupload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Kerusakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" action="{{ route('backsite.device_more.create-kerusakan') }}" method="POST">

                @csrf
                <div class="modal-body">
                    <input type="hidden" name="device_more_id" id="device_more_id" value="{{ $id }}">
                    <div class="form-group row">
                        <label class="col-md-4 label-control" for="tgl_perbaikan">Tgl Perbaikan
                            <code style="color:red;">required</code></label>
                        <div class="col-md-8">
                            <input type="text" id="tgl_perbaikan" name="tgl_perbaikan" class="form-control"
                                value="{{ old('tgl_perbaikan') }}" autocomplete="off" required>

                            @if ($errors->has('tgl_perbaikan'))
                                <p style="font-style: bold; color: red;">
                                    {{ $errors->first('tgl_perbaikan') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 label-control" for="description">Keterangan <code
                                style="color:red;">required</code></label>
                        <div class="col-md-8">
                            <textarea rows="5" class="form-control" id="description" name="description"></textarea>

                            @if ($errors->has('description'))
                                <p style="font-style: bold; color: red;">
                                    {{ $errors->first('description') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" style="width:120px;" class="btn btn-cyan"
                        onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                        <i class="la la-check-square-o"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Date Picker
    const fpDate = flatpickr('#tgl_perbaikan', {
        altInput: true,
        altFormat: 'd F Y',
        dateFormat: 'Y-m-d',
        disableMobile: 'true',
    });
</script>
