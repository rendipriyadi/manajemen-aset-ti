@extends('layouts.app')

{{-- set title --}}
@section('title', 'Create - Device User')

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
                    <h3 class="mb-0 content-header-title d-inline-block">Create Device User</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Device User</li>
                                <li class="breadcrumb-item active">Create</li>
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
                                    <form class="form form-horizontal" action="{{ route('backsite.device_user.store') }}"
                                        method="POST" enctype="multipart/form-data">

                                        @csrf

                                        <div class="form-body">
                                            <div class="form-section">
                                                <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="employee_id">User
                                                    <code style="color:red;">required</code></label>
                                                <div class="col-md-7">
                                                    <select name="employee_id" id="employee_id"
                                                        class="form-control select2">
                                                        <option value="{{ '' }}" disabled selected>
                                                            Pilih User
                                                        </option>
                                                        @foreach ($employee as $key => $employee_item)
                                                            <option value="{{ $employee_item->id }}">
                                                                {{ $employee_item->nip }} -
                                                                {{ $employee_item->name }} -
                                                                {{ $employee_item->division->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('employee_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('employee_id') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="device_pc_id">PC <code
                                                        style="color:red;">required</code></label>
                                                <div class="col-md-7">
                                                    <select name="device_pc_id" id="device_pc_id"
                                                        class="form-control select2" required>
                                                        <option value="{{ '' }}" disabled selected>
                                                            Pilih PC
                                                        </option>
                                                        @foreach ($device_pc as $key => $device_pc_item)
                                                            <option value="{{ $device_pc_item->id }}">
                                                                {{ $device_pc_item->no_asset }} -
                                                                {{ $device_pc_item->name }} -
                                                                {{ $device_pc_item->processor->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('device_pc_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('device_pc_id') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 label-control" for="processor">Processor</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="processor" name="processor"
                                                        class="form-control" value="{{ old('processor') }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 label-control" for="motherboard">Motherboard</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="motherboard" name="motherboard"
                                                        class="form-control" value="{{ old('motherboard') }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 label-control" for="ram">Ram</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="ram" name="ram" class="form-control"
                                                        value="{{ old('ram') }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 label-control" for="hardisk">Hardisk</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="hardisk" name="hardisk" class="form-control"
                                                        value="{{ old('hardisk') }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="device_monitor_id">Monitor
                                                    <code style="color:red;">required</code></label>
                                                <div class="col-md-7">
                                                    <select name="device_monitor_id[]" id="device_monitor_id"
                                                        class="form-control select2-full-bg" data-bgcolor="teal"
                                                        data-bgcolor-variation="lighten-3" data-text-color="black"
                                                        multiple="multiple" required>
                                                        @foreach ($device_monitor as $key => $device_monitor_item)
                                                            <option value="{{ $device_monitor_item->id }}">
                                                                {{ $device_monitor_item->no_asset }} -
                                                                {{ $device_monitor_item->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('device_monitor_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('device_monitor_id') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="device_additional_id">Aksesoris
                                                    <code style="color:red;">required</code></label>
                                                <div class="col-md-7">
                                                    <select name="device_additional_id[]" id="device_additional_id"
                                                        class="form-control select2-full-bg" data-bgcolor="teal"
                                                        data-bgcolor-variation="lighten-3" data-text-color="black"
                                                        multiple="multiple" required>
                                                        @foreach ($device_additional as $key => $device_additional_item)
                                                            <option value="{{ $device_additional_item->id }}">
                                                                {{ $device_additional_item->no_non_asset }} -
                                                                {{ $device_additional_item->type_device->name }} -
                                                                {{ $device_additional_item->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('device_additional_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('device_additional_id') }}</p>
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
                                                        @foreach ($device_more as $key => $device_more_item)
                                                            <option value="{{ $device_more_item->id }}">
                                                                {{ $device_more_item->no_asset }} -
                                                                {{ $device_more_item->type_device->name }} -
                                                                {{ $device_more_item->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('device_more_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('device_more_id') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="software_id">Software
                                                    <code style="color:red;">required</code></label>
                                                <div class="col-md-7">
                                                    <select name="software_id[]" id="software_id"
                                                        class="form-control select2-full-bg" data-bgcolor="teal"
                                                        data-bgcolor-variation="lighten-3" data-text-color="black"
                                                        multiple="multiple" required>
                                                        @foreach ($software as $key => $software_item)
                                                            <option value="{{ $software_item->id }}">
                                                                {{ $software_item->software_category }} -
                                                                {{ $software_item->software_name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('software_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('software_id') }}</p>
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
                                                            Pilih Lokasi
                                                        </option>
                                                        @foreach ($location as $key => $location_item)
                                                            <option value="{{ $location_item->id }}">
                                                                {{ $location_item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('location_detail_id'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('location_detail_id') }}</p>
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
                                                        <option value="1">Aktif</option>
                                                        <option value="2">Tidak Aktif</option>
                                                    </select>

                                                    @if ($errors->has('status'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('status') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="tgl_deploy">Tanggal Deploy<code
                                                        style="color:red;">required</code></label>
                                                <div class="col-md-7">
                                                    <input type="text" id="tgl_deploy" name="tgl_deploy"
                                                        class="form-control" value="{{ old('tgl_deploy') }}" required />

                                                    @if ($errors->has('tgl_deploy'))
                                                        <p style="font-style: bold; color: red;">
                                                            {{ $errors->first('tgl_deploy') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="file">File
                                                    <code style="color:red;">optional</code></label>
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
                                                    <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
                                                </div>
                                            </div>
                                            <div class="text-right form-actions">
                                                <a href="{{ route('backsite.device_user.index') }}" style="width:120px;"
                                                    class="mr-1 text-white btn bg-blue-grey"
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

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#device_pc_id').change(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: "{{ route('backsite.device_user.get_data_pc') }}",
                    data: {
                        id: $(this).val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            let data = response.sukses;

                            $('#processor').val(data.processor);
                            $('#motherboard').val(data.motherboard);
                            $('#ram').val(data.ram);
                            $('#hardisk').val(data.hardisk);
                        }

                        if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: response.error
                            }).then(result => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            });
        });
    </script>
@endpush
