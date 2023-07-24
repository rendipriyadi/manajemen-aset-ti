@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Software')

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
                    <h3 class="mb-0 content-header-title d-inline-block">Edit Software</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Software</li>
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
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-basic">Form Input</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="mb-0 list-inline">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <form class="form form-horizontal"
                                            action="{{ route('backsite.software.update', [$software->id]) }}" method="POST"
                                            enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="software_name">Nama Software
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="software_name" name="software_name"
                                                            class="form-control"
                                                            value="{{ old('name', isset($software->software_name) ? $software->software_name : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('software_name'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('software_name') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="software_category">Kategori
                                                        Software<code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="software_category" id="software_category"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="Sistem"
                                                                {{ $software->software_category == 'Sistem' ? 'selected' : '' }}>
                                                                Sistem
                                                            </option>
                                                            <option value="Aplikasi"
                                                                {{ $software->software_category == 'Aplikasi' ? 'selected' : '' }}>
                                                                Aplikasi</option>
                                                        </select>

                                                        @if ($errors->has('software_category'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('software_category') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="serial_number">Serial Number
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="serial_number" name="serial_number"
                                                            class="form-control" placeholder="Isi serial number"
                                                            value="{{ old('serial_number', isset($software->serial_number) ? $software->serial_number : '') }}"
                                                            autocomplete="off">

                                                        @if ($errors->has('serial_number'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('serial_number') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="license_amount">Jumlah
                                                        Lisensi
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="license_amount" name="license_amount"
                                                            class="form-control"
                                                            value="{{ old('license_amount', isset($software->license_amount) ? $software->license_amount : '') }}"
                                                            autocomplete="off">

                                                        @if ($errors->has('license_amount'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('license_amount') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="start_license">Awal Lisensi
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="start_license" name="start_license"
                                                            class="form-control"
                                                            value="{{ old('start_license', isset($software->start_license) ? $software->start_license : '') }}"
                                                            required>

                                                        @if ($errors->has('start_license'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('start_license') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="finish_license">Akhir
                                                        Lisensi
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="finish_license" name="finish_license"
                                                            class="form-control"
                                                            value="{{ old('finish_license', isset($software->finish_license) ? $software->finish_license : '') }}">

                                                        @if ($errors->has('finish_license'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('finish_license') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="no_pp">No PP
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="no_pp" name="no_pp"
                                                            class="form-control"
                                                            value="{{ old('no_pp', isset($software->no_pp) ? $software->no_pp : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('no_pp'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('no_pp') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="license_type">Tipe
                                                        Lisensi<code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <select name="license_type" id="license_type"
                                                            class="form-control select2">
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="Perpetual"
                                                                {{ $software->license_type == 'Perpetual' ? 'selected' : '' }}>
                                                                Perpetual</option>
                                                            <option value="Subscribe"
                                                                {{ $software->license_type == 'Subscribe' ? 'selected' : '' }}>
                                                                Subscribe</option>
                                                        </select>

                                                        @if ($errors->has('license_type'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('license_type') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="purchase_year">Tahun
                                                        Pembelian
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="purchase_year"
                                                            id="purchase_year" data-provide="datepicker"
                                                            data-date-format="yyyy" data-date-min-view-mode="2"
                                                            autocomplete="off"
                                                            value="{{ isset($software->purchase_year) ? $software->purchase_year : '' }}">

                                                        @if ($errors->has('purchase_year'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('purchase_year') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="status">Status<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <select name="status" id="status"
                                                            class="form-control select2">
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="1"
                                                                {{ $software->status == 1 ? 'selected' : '' }}>Aktif
                                                            </option>
                                                            <option value="2"
                                                                {{ $software->status == 2 ? 'selected' : '' }}>Tidak Aktif
                                                            </option>
                                                        </select>

                                                        @if ($errors->has('status'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('status') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control"
                                                        for="description">Keterangan<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-10">
                                                        <textarea rows="4" class="form-control summernote" id="description" name="description">{{ isset($software->description) ? $software->description : '' }}</textarea>
                                                        <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                                + Enter jika ingin pindah baris</small></p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="text-right form-actions">
                                                <a href="{{ route('backsite.software.index') }}" style="width:120px;"
                                                    class="mr-1 text-white btn bg-blue-grey"
                                                    onclick="return confirm('Yakin ingin menutup halaman ini? , Setiap perubahan yang Anda buat tidak akan disimpan.')">
                                                    <i class="ft-x"></i> Cancel
                                                </a>
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

        </div>
    </div>
    <!-- END: Content-->

@endsection

@push('after-style')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('after-script')
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
    <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        // Date Picker
        const fpDate = flatpickr('#start_license', {
            altInput: true,
            altFormat: 'd F Y',
            dateFormat: 'Y-m-d',
            disableMobile: 'true',
        });

        // Date Picker
        const foDate = flatpickr('#finish_license', {
            altInput: true,
            altFormat: 'd F Y',
            dateFormat: 'Y-m-d',
            disableMobile: 'true',
        });

        // summernote 1
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
    </script>
@endpush
