@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Device Division')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            {{-- error --}}
            @if ($errors->any())
                <div class="mb-2 alert bg-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- breadcumb --}}
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <h3 class="mb-0 content-header-title d-inline-block">Edit Device Division</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Device Division</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- forms --}}
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="form form-horizontal"
                                        action="{{ route('backsite.device_division.update', [$device_division->id]) }}"
                                        method="POST" enctype="multipart/form-data">

                                        @method('PUT')
                                        @csrf

                                        <div class="form-body">
                                            <div class="form-section">
                                                <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="division_id">Division
                                                    <code style="color:red;">required</code></label>
                                                <div class="col-md-7">
                                                    <select name="division_id" id="division_id"
                                                        class="form-control select2">
                                                        <option value="{{ '' }}" disabled selected>
                                                            Pilih Divisi
                                                        </option>
                                                        @foreach ($division as $key => $division_item)
                                                            <option value="{{ $division_item->id }}"
                                                                {{ $division_item->id == $device_division->division_id ? 'selected' : '' }}>
                                                                {{ $division_item->name }}
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('division_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('division_id') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="device_more_id">Perangkat
                                                    Tambahan <code style="color:red;">required</code></label>
                                                <div class="col-md-7">
                                                    <select name="device_more_id[]" id="device_more_id"
                                                        class="form-control select2-full-bg" data-bgcolor="teal"
                                                        data-bgcolor-variation="lighten-3" data-text-color="black"
                                                        multiple="multiple">
                                                        @php
                                                            $data_more = explode(',', $device_division->device_more_id);
                                                        @endphp
                                                        @foreach ($device_more as $key => $device_more_item)
                                                            @if ($device_more_item->status != 2 || in_array($device_more_item->id, $data_more))
                                                                <option value="{{ $device_more_item->id }}"
                                                                    {{ in_array($device_more_item->id, $data_more) ? 'selected' : '' }}>
                                                                    {{ $device_more_item->no_asset }} -
                                                                    {{ $device_more_item->type_device->name }} -
                                                                    {{ $device_more_item->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('device_more_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('device_more_id') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="location_id">Lokasi
                                                    <code style="color:red;">optional</code></label>
                                                <div class="col-md-7">
                                                    <select name="location_id" id="location_id"
                                                        class="form-control select2">
                                                        <option value="{{ '' }}" disabled selected>
                                                            Pilih PC
                                                        </option>
                                                        @foreach ($location as $key => $location_item)
                                                            <option value="{{ $location_item->id }}"
                                                                {{ $location_item->id == $device_division->location_id ? 'selected' : '' }}>
                                                                {{ $location_item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('location_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('location_id') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="status">Status<code
                                                        style="color:red;">optional</code></label>
                                                <div class="col-md-7">
                                                    <select name="status" id="statusa" class="form-control select2">
                                                        <option value="{{ '' }}" disabled selected>
                                                            Choose
                                                        </option>
                                                        <option value="1"
                                                            {{ $device_division->status == 1 ? 'selected' : '' }}>Aktif
                                                        </option>
                                                        <option value="2"
                                                            {{ $device_division->status == 2 ? 'selected' : '' }}>Tidak
                                                            Aktif
                                                        </option>
                                                    </select>

                                                    @if ($errors->has('status'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('status') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="tgl_deploy">Tanggal Deploy<code
                                                        style="color:red;">optional</code></label>
                                                <div class="col-md-7">
                                                    <input type="text" id="tgl_deploy" name="tgl_deploy"
                                                        class="form-control"
                                                        value="{{ old('tgl_deploy', isset($device_division->tgl_deploy) ? $device_user->tgl_deploy : '') }}"
                                                        required />

                                                    @if ($errors->has('tgl_deploy'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('tgl_deploy') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="file">Ganti File <code
                                                        style="color:red;">optional</code></label>
                                                <div class="col-md-7">
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
                                                <label class="col-md-3 label-control" for="description">Keterangan<code
                                                        style="color:red;">optional</code></label>
                                                <div class="col-md-7">
                                                    <textarea rows="5" class="form-control summernote" id="description" name="description">{{ isset($device_division->description) ? $device_division->description : '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="text-right form-actions">
                                                <a href="{{ route('backsite.device_division.index') }}"
                                                    style="width:120px;" class="mr-1 text-white btn bg-blue-grey"
                                                    onclick="return confirm('Yakin ingin menutup halaman ini? , Setiap perubahan yang Anda buat tidak akan disimpan.')">
                                                    <i class="ft-x"></i> Cancel
                                                </a>
                                                <button type="submit" style="width:120px;" class="btn btn-cyan"
                                                    onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                                    <i class="la la-check-square-o"></i> Submit
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
    <!-- END: Content-->
    <div class="viewmodal" style="display: none;"></div>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('after-script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>

    <script>
        // summernote
        $('.summernote').summernote({
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
            ],
        });

        $('.summernote').summernote('fontSize', '12');

        // Date Picker
        const fpDate = flatpickr('#tgl_deploy', {
            altInput: true,
            altFormat: 'd F Y',
            dateFormat: 'Y-m-d',
            disableMobile: 'true',
        });
    </script>
@endpush
