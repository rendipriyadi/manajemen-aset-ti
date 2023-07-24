@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Perangkat Tambahan')

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
                    <h3 class="mb-0 content-header-title d-inline-block">Edit Perangkat Tambahan</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Perangkat Tambahan</li>
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
                                        <form class="form"
                                            action="{{ route('backsite.device_more.update', [$device_more->id]) }}"
                                            method="POST" enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="no_asset">No
                                                        Asset
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="no_asset" name="no_asset"
                                                            class="form-control"
                                                            value="{{ old('no_asset', isset($device_more->no_asset) ? $device_more->no_asset : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('no_asset'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('no_asset') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="type_device">Perangkat
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="type_device_id" id="type_device"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            @foreach ($consumables as $key => $consumables_item)
                                                                <option value="{{ $consumables_item->id }}"
                                                                    {{ $consumables_item->id == $device_more->type_device_id ? 'selected' : '' }}>
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
                                                    <label class="col-md-2 label-control" for="name">Nama Perangkat
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="name" name="name"
                                                            class="form-control" placeholder="isi nama perangkat"
                                                            value="{{ old('name', isset($device_more->name) ? $device_more->name : '') }}"
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
                                                            value="{{ old('specification', isset($device_more->specification) ? $device_more->specification : '') }}"
                                                            autocomplete="off">

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
                                                        <select name="status" id="status" class="form-control select2">
                                                            <option value="1"
                                                                {{ $device_more->status == 1 ? 'selected' : '' }}>
                                                                Ready to Deploy</option>
                                                            <option value="2"
                                                                {{ $device_more->status == 2 ? 'selected' : '' }}>
                                                                Deploy</option>
                                                        </select>

                                                        @if ($errors->has('status'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('status') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="file">Ganti File
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="file" name="file">
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
                                                    <label class="col-md-2 label-control"
                                                        for="description">Keterangan<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" class="form-control summernote" id="description" name="description">{{ isset($device_more->description) ? $device_more->description : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-left: 5px;">
                                                    <button type="button" class="btn btn-primary">Data IP
                                                        Address</button>
                                                </div>
                                                <div class="row" style="margin-left: 5px;">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <table align="center" width="100%" id="tableMore">
                                                                <tr>
                                                                    <th>Port</th>
                                                                    <th>IP Address</th>
                                                                    <th>Keterangan</th>
                                                                    <th style="width:100px;">#</th>
                                                                </tr>
                                                                @foreach ($ip_address as $ip_address_item)
                                                                    <tr>
                                                                        <td>
                                                                            <input type="hidden" id="id"
                                                                                name="id[]"
                                                                                value="{{ $ip_address_item->id }}">
                                                                            <input type="text" id="port"
                                                                                name="port[]" class="form-control"
                                                                                value="{{ $ip_address_item->port }}"
                                                                                autocomplete="off">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="ip_address"
                                                                                name="ip_address[]" class="form-control"
                                                                                value="{{ $ip_address_item->ip_address }}"
                                                                                maxlength="15" autocomplete="off">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="keterangan"
                                                                                name="keterangan[]" class="form-control"
                                                                                value="{{ $ip_address_item->keterangan }}"
                                                                                autocomplete="off">
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn-sm btn-success"
                                                                                id="btnPlusMore"><i
                                                                                    class="la la-plus"></i></button>
                                                                            <button type="button"
                                                                                class="btn-sm btn-danger"
                                                                                onclick="hapus('{{ $ip_address_item->id }}')"><i
                                                                                    class="la la-minus"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="text-right form-actions">
                                                <a href="{{ route('backsite.device_hardware.index') }}"
                                                    style="width:120px;" class="mr-1 text-white btn bg-blue-grey"
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/third-party/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('after-script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ asset('/assets/third-party/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        // create multiple input ip address pc
        $("#btnPlusMore").click(function() {
            $("#tableMore").append(`
                <tr>
                    <td>
                        <input type="text" id="port_ip" name="port_ip[]" class="form-control" value="{{ old('port') }}" autocomplete="off">
                    </td>
                    <td>
                        <input type="text" id="address_ip" name="address_ip[]" class="form-control" value="{{ old('ip_address') }}" maxlength="15" autocomplete="off">
                    </td>
                    <td>
                        <input type="text" id="keterangan_ip" name="keterangan_ip[]" class="form-control" value="{{ old('keterangan') }}" autocomplete="off">
                    </td>
                    <td>
                        <button type="button" class="btn-sm btn-danger" id="btnMinMore"><i class="la la-minus"></i></button>
                    </td>
                </tr>
            `);
        });

        $(document).on('click', '#btnMinMore', function() {
            $(this).parents('tr').remove();
        });

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

        function hapus(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: 'Hapus',
                html: `Apakah anda yakin ingin menghapus data ini ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('backsite.device_more.delete_ip') }}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    html: response.sukses
                                }).then((result) => {
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
                }
            });
        }
    </script>
@endpush
