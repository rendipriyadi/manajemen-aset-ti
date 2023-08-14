<form class="form mt-2" action="{{ route('backsite.device_pc.export-pdf') }}" method="POST">

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
@if (Auth::user()->detail_user->type_user_id == 2)
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

                                <form class="form" action="{{ route('backsite.device_pc.store') }}" method="POST"
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
                                                <input type="text" id="no_asset" name="no_asset"
                                                    class="form-control" value="{{ old('no_asset') }}"
                                                    autocomplete="off" required>

                                                @if ($errors->has('no_asset'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('no_asset') }}</p>
                                                @endif
                                            </div>
                                            <label class="col-md-2 label-control" for="name">Nama <code
                                                    style="color:red;">required</code></label>
                                            <div class="col-md-4">
                                                <input type="text" id="name" name="name" class="form-control"
                                                    placeholder="isi nama pc" value="{{ old('name') }}"
                                                    autocomplete="off" required>

                                                @if ($errors->has('name'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('name') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="processor_id">Processor <code
                                                    style="color:red;">required</code></label>
                                            <div class="col-md-4">
                                                <select name="processor_id" id="processor_id"
                                                    class="form-control select2" required>
                                                    <option value="{{ '' }}" disabled selected>
                                                        Choose
                                                    </option>
                                                    @foreach ($processor as $processor => $processor_item)
                                                        <option value="{{ $processor_item->id }}">
                                                            {{ $processor_item->name }}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('processor_id'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('processor_id') }}</p>
                                                @endif
                                            </div>
                                            <label class="col-md-2 label-control" for="motherboard_id">Motherboard
                                                <code style="color:red;">required</code></label>
                                            <div class="col-md-4">
                                                <select name="motherboard_id" id="motherboard_id"
                                                    class="form-control select2" required>
                                                    <option value="{{ '' }}" disabled selected>
                                                        Choose
                                                    </option>
                                                    @foreach ($motherboard as $motherboard => $motherboard_item)
                                                        <option value="{{ $motherboard_item->id }}">
                                                            {{ $motherboard_item->name }}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('motherboard_id'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('motherboard_id') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="ram_id">Ram <code
                                                    style="color:red;">required</code></label>
                                            <div class="col-md-4">
                                                <select name="ram_id[]" id="role"
                                                    class="form-control select2-full-bg" data-bgcolor="teal"
                                                    data-bgcolor-variation="lighten-3" data-text-color="black"
                                                    multiple="multiple" required>
                                                    @foreach ($ram as $ram => $ram_item)
                                                        <option value="{{ $ram_item->id }}">
                                                            {{ $ram_item->name }}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('ram_id'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('ram_id') }}</p>
                                                @endif
                                            </div>
                                            <label class="col-md-2 label-control" for="hardisk_id">Hardisk <code
                                                    style="color:red;">required</code></label>
                                            <div class="col-md-4">
                                                <select name="hardisk_id[]" id="roel"
                                                    class="form-control select2-full-bg" data-bgcolor="teal"
                                                    data-bgcolor-variation="lighten-3" data-text-color="black"
                                                    multiple="multiple" required>
                                                    @foreach ($hardisk as $hardisk => $hardisk_item)
                                                        <option value="{{ $hardisk_item->id }}">
                                                            {{ $hardisk_item->name }}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('hardisk_id'))
                                                    <p style="font-style: bold; color: red;">
                                                        {{ $errors->first('hardisk_id') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="status">Status<code
                                                    style="color:red;">optional</code></label>
                                            <div class="col-md-4">
                                                <select name="status" id="statusa" class="form-control select2">
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
    {{-- table card --}}
    <div class="content-body">
        <section id="table-home">
            <!-- Zero configuration table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List PC</h4>
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
                                    <table
                                        class="table table-striped table-bordered text-inputs-searching default-table">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center; width:50px;">No</th>
                                                <th style="text-align:center;">No Asset</th>
                                                <th style="text-align:center;">Nama</th>
                                                <th style="text-align:center;">Motherboard</th>
                                                <th style="text-align:center;">Processor</th>
                                                <th style="text-align:center;">Hardisk</th>
                                                <th style="text-align:center;">Ram</th>
                                                <th style="text-align:center;">Status</th>
                                                <th style="text-align:center; width:100px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($device_pc as $key => $device_pc_item)
                                                <tr data-entry-id="{{ $device_pc_item->id }}">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center"> <span
                                                            class="badge badge-success">{{ $device_pc_item->no_asset }}</span>
                                                    </td>
                                                    <td class="text-center">{{ $device_pc_item->name }}</td>
                                                    <td class="text-center">{{ $device_pc_item->motherboard->name }}
                                                    </td>
                                                    <td class="text-center">{{ $device_pc_item->processor->name }}
                                                    </td>
                                                    <td class="text-center">
                                                        @foreach (explode(',', $device_pc_item->hardisk_id) as $data_hardisk)
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
                                                    <td class="text-center">
                                                        @foreach (explode(',', $device_pc_item->ram_id) as $data_ram)
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
                                                    <td class="text-center">
                                                        @if ($device_pc_item->status == 1)
                                                            <span
                                                                class="badge badge-info">{{ 'Ready to Deploy' }}</span>
                                                        @elseif($device_pc_item->status == 2)
                                                            <span
                                                                class="badge badge-success">{{ 'Deploy' }}</span>
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
                                                                    data-remote="{{ route('backsite.device_pc.show', encrypt($device_pc_item->id)) }}"
                                                                    data-toggle="modal" data-target="#mymodal"
                                                                    data-title="Detail Device PC"
                                                                    class="dropdown-item">
                                                                    Show
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('backsite.device_pc.edit', encrypt($device_pc_item->id)) }}">
                                                                    Edit
                                                                </a>
                                                                <form
                                                                    action="{{ route('backsite.device_pc.destroy', encrypt($device_pc_item->id)) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                    <input type="hidden" name="_method"
                                                                        value="DELETE">
                                                                    <input type="hidden" name="_token"
                                                                        value="{{ csrf_token() }}">
                                                                    <input type="submit" class="dropdown-item"
                                                                        value="Delete">
                                                                </form>
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="riwayatKerusakanPc('{{ $device_pc_item->id }}')">Riwayat
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
                                                <th>Nama</th>
                                                <th>Motherboard</th>
                                                <th>Processor</th>
                                                <th>Hardisk</th>
                                                <th>Ram</th>
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
@endif
