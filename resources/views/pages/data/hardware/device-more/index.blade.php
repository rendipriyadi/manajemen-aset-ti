<div class="content-body">
    <section id="add-home">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <a data-action="collapse">
                            <h4 class="card-title text-white">Tambah Data</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </a>
                    </div>

                    <div class="card-content collapse hide">
                        <div class="card-body card-dashboard">

                            <form class="form" action="{{ route('backsite.device_more.store') }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                <div class="form-body">
                                    <div class="form-section">
                                        <p>Isi input <code>required</code>, Sebelum menekan tombol submit.
                                        </p>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 label-control" for="no_asset">No
                                            Asset
                                            <code style="color:red;">required</code></label>
                                        <div class="col-md-4">
                                            <input type="text" id="no_asset" name="no_asset" class="form-control"
                                                value="{{ old('no_asset') }}" autocomplete="off" required>

                                            @if ($errors->has('no_asset'))
                                                <p style="font-style: bold; color: red;">
                                                    {{ $errors->first('no_asset') }}</p>
                                            @endif
                                        </div>
                                        <label class="col-md-2 label-control" for="type_device_id">Perangkat
                                            <code style="color:red;">required</code></label>
                                        <div class="col-md-4">
                                            <select name="type_device_id" id="type_device_id"
                                                class="form-control select2" required>
                                                <option value="{{ '' }}" disabled selected>
                                                    Choose
                                                </option>
                                                @foreach ($consumables as $consumables => $consumables_item)
                                                    <option value="{{ $consumables_item->id }}">
                                                        {{ $consumables_item->name }}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('type_device_id'))
                                                <p style="font-style: bold; color: red;">
                                                    {{ $errors->first('type_device_id') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 label-control" for="name">Nama Perangkat <code
                                                style="color:red;">required</code></label>
                                        <div class="col-md-4">
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="isi nama perangkat" value="{{ old('name') }}"
                                                autocomplete="off" required>

                                            @if ($errors->has('name'))
                                                <p style="font-style: bold; color: red;">
                                                    {{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <label class="col-md-2 label-control" for="specification">Spesifikasi
                                            <code style="color:red;">optional</code></label>
                                        <div class="col-md-4">
                                            <input type="text" id="specification" name="specification"
                                                class="form-control" placeholder="isi spesifikasi perangkat"
                                                value="{{ old('specification') }}" autocomplete="off">

                                            @if ($errors->has('specification'))
                                                <p style="font-style: bold; color: red;">
                                                    {{ $errors->first('specification') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 label-control" for="status">Status<code
                                                style="color:red;">optional</code></label>
                                        <div class="col-md-4">
                                            <select name="status" id="statusb" class="form-control select2">
                                                <option value="{{ '' }}" disabled selected>
                                                    Choose
                                                </option>
                                                <option value="1">Ready to Deploy</option>
                                                <option value="2">Deploy</option>
                                            </select>

                                            @if ($errors->has('status'))
                                                <p style="font-style: bold; color: red;">
                                                    {{ $errors->first('status') }}</p>
                                            @endif
                                        </div>
                                        <label class="col-md-2 label-control" for="file">File
                                            <code style="color:red;">optional</code></label>
                                        <div class="col-md-4">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file"
                                                    name="file">
                                                <label class="custom-file-label" for="file"
                                                    aria-describedby="file">Pilih
                                                    File</label>
                                            </div>
                                            <p class="text-muted"><small class="text-danger">Hanya dapat
                                                    mengunggah 1 file</small></p>

                                            @if ($errors->has('file'))
                                                <p style="font-style: bold; color: red;">
                                                    {{ $errors->first('file') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 label-control" for="description">Keterangan<code
                                                style="color:red;">optional</code></label>
                                        <div class="col-md-10">
                                            <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-left: 5px;">
                                        <a class="btn btn-primary" data-toggle="collapse"
                                            href="#multiCollapseExample2" role="button" aria-expanded="false"
                                            aria-controls="multiCollapseExample2">Tambah IP Address</a>
                                    </div>
                                    <div class="row" style="margin-left: 5px;">
                                        <div class="col">
                                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                                <div class="form-group row">
                                                    <table align="center" width="100%" id="tableMore">
                                                        <tr>
                                                            <th>Port</th>
                                                            <th>IP Address</th>
                                                            <th>Keterangan</th>
                                                            <th style="width:50px;">#</th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" id="port" name="port[]"
                                                                    class="form-control" value="{{ old('port') }}"
                                                                    autocomplete="off">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="ip_address"
                                                                    name="ip_address[]" class="form-control"
                                                                    value="{{ old('ip_address') }}"
                                                                    autocomplete="off">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="keterangan"
                                                                    name="keterangan[]" class="form-control"
                                                                    value="{{ old('keterangan') }}"
                                                                    autocomplete="off">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn-sm btn-success"
                                                                    id="btnPlusMore"><i
                                                                        class="la la-plus"></i></button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions text-right">
                                    <button type="submit" style="width:120px;" class="btn btn-cyan"
                                        onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                        <i class="la la-check-square-o"></i> Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<form class="form" action="{{ route('backsite.device_more.export-pdf') }}" method="POST">

    @csrf
    <div class="form-group row">
        <label class="col-md-1 label-control" for="dari">Dari </label>
        <div class="col-md-2">
            <input type="text" id="dari" name="dari" class="form-control" value="{{ old('dari') }}"
                required />
        </div>
        <label class="col-md-1 label-control" for="sampai">Sampai </label>
        <div class="col-md-2">
            <input type="text" id="sampai" name="sampai" class="form-control" value="{{ old('sampai') }}"
                required />
        </div>
        <div class="col-md-2">
            <input type="submit" style="width:100px; height:40px" class="btn btn-danger" value="Export PDF">
        </div>
    </div>
</form>
{{-- table card --}}
<div class="content-body">
    <section id="table-home">
        <!-- Zero configuration table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List Perangkat Tambahan</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="mb-0 list-inline">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                            </ul>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered text-inputs-searching default-table">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; width:50px;">No</th>
                                            <th style="text-align:center;">No Asset</th>
                                            <th style="text-align:center;">Perangkat</th>
                                            <th style="text-align:center;">Nama Perangkat</th>
                                            <th style="text-align:center;">Spesifikasi</th>
                                            <th style="text-align:center;">Ip Address</th>
                                            <th style="text-align:center;">File</th>
                                            <th style="text-align:center;">Status</th>
                                            <th style="text-align:center; width:100px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($device_more as $key => $device_more_item)
                                            <tr data-entry-id="{{ $device_more_item->id }}">
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center"> <span
                                                        class="badge badge-success">{{ $device_more_item->no_asset }}</span>
                                                </td>
                                                <td class="text-center">{{ $device_more_item->type_device->name }}
                                                </td>
                                                <td class="text-center">{{ $device_more_item->name ?? 'N?A' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $device_more_item->specification ?? 'N/A' }}</td>
                                                <td class="text-center">
                                                    @php
                                                        $data_ip = DB::table('ip_address_more')
                                                            ->where('device_more_id', $device_more_item->id)
                                                            ->get();
                                                    @endphp
                                                    @foreach ($data_ip as $data_ip_item)
                                                        {{ $data_ip_item->ip_address }} -
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    <a data-fancybox="gallery"
                                                        data-src="{{ asset('storage/' . $device_more_item->file) }}"
                                                        class="blue accent-4 dropdown-item">Show</a>
                                                </td>
                                                <td class="text-center">
                                                    @if ($device_more_item->status == 1)
                                                        <span class="badge badge-info">{{ 'Ready to Deploy' }}</span>
                                                    @elseif($device_more_item->status == 2)
                                                        <span class="badge badge-success">{{ 'Deploy' }}</span>
                                                    @else
                                                        <span>{{ 'N/A' }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="mb-1 mr-1 btn-group">
                                                        <button type="button"
                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu">
                                                            <a href="#mymodal"
                                                                data-remote="{{ route('backsite.device_more.show', encrypt($device_more_item->id)) }}"
                                                                data-toggle="modal" data-target="#mymodal"
                                                                data-title="Detail Perangkat Tambahan"
                                                                class="dropdown-item">
                                                                Show
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('backsite.device_more.edit', encrypt($device_more_item->id)) }}">
                                                                Edit
                                                            </a>
                                                            <form
                                                                action="{{ route('backsite.device_more.destroy', encrypt($device_more_item->id)) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <input type="submit" class="dropdown-item"
                                                                    value="Delete">
                                                            </form>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="riwayatKerusakanMore('{{ $device_more_item->id }}')">Riwayat
                                                                Kerusakan
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            {{-- not found --}}
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>No Asset</th>
                                            <th>Perangkat</th>
                                            <th>Nama Perangkat</th>
                                            <th>Spesifikasi</th>
                                            <th>Ip Address</th>
                                            <th>File</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
