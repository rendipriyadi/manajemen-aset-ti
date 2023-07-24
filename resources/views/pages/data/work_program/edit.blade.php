@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Program Kerja')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            {{-- error --}}
            @if ($errors->any())
                <div class="alert bg-danger alert-dismissible mb-2" role="alert">
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
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Program Kerja</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Program Kerja</li>
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
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <form class="form form-horizontal"
                                            action="{{ route('backsite.work_program.update', [$work_program->id]) }}"
                                            method="POST" enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="work_program">Program Kerja
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="work_program" id="work_program"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="1"
                                                                {{ $work_program->work_program == 1 ? 'selected' : '' }}>
                                                                Teknologi Informasi</option>
                                                            <option value="2"
                                                                {{ $work_program->work_program == 2 ? 'selected' : '' }}>
                                                                Hardware</option>
                                                            <option value="3"
                                                                {{ $work_program->work_program == 3 ? 'selected' : '' }}>
                                                                Jaringan</option>
                                                            <option value="4"
                                                                {{ $work_program->work_program == 4 ? 'selected' : '' }}>
                                                                Peralatan Tol</option>
                                                            <option value="5"
                                                                {{ $work_program->work_program == 5 ? 'selected' : '' }}>
                                                                Sistem Informasi</option>
                                                        </select>

                                                        @if ($errors->has('work_program'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('work_program') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="year">Tahun
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="year"
                                                            id="year" data-provide="datepicker" data-date-format="yyyy"
                                                            data-date-min-view-mode="2"
                                                            value="{{ isset($work_program->year) ? $work_program->year : '' }}"
                                                            autocomplete="off">

                                                        @if ($errors->has('year'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('year') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="general">Umum<code
                                                            style="color:red;">reuqired</code></label>
                                                    <div class="col-md-4">
                                                        <textarea rows="5" class="form-control" id="general" name="general" required>{{ isset($work_program->general) ? $work_program->general : '' }}</textarea>
                                                    </div>
                                                    <label class="col-md-2 label-control" for="technical">Teknis<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <textarea rows="5" class="form-control" id="technical" name="technical">{{ isset($work_program->technical) ? $work_program->technical : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="progress">Progress
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="progress" id="progress" class="form-control select2"
                                                            required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="0 %"
                                                                {{ $work_program->progress == '0 %' ? 'selected' : '' }}>
                                                                0 %</option>
                                                            <option value="10 %"
                                                                {{ $work_program->progress == '10 %' ? 'selected' : '' }}>
                                                                10 %</option>
                                                            <option value="20 %"
                                                                {{ $work_program->progress == '20 %' ? 'selected' : '' }}>
                                                                20 %</option>
                                                            <option value="30 %"
                                                                {{ $work_program->progress == '30 %' ? 'selected' : '' }}>
                                                                30 %</option>
                                                            <option value="40 %"
                                                                {{ $work_program->progress == '40 %' ? 'selected' : '' }}>
                                                                40 %</option>
                                                            <option value="50 %"
                                                                {{ $work_program->progress == '50 %' ? 'selected' : '' }}>
                                                                50 %</option>
                                                            <option value="60 %"
                                                                {{ $work_program->progress == '60 %' ? 'selected' : '' }}>
                                                                60 %</option>
                                                            <option value="70 %"
                                                                {{ $work_program->progress == '70 %' ? 'selected' : '' }}>
                                                                70 %</option>
                                                            <option value="80 %"
                                                                {{ $work_program->progress == '80 %' ? 'selected' : '' }}>
                                                                80 %</option>
                                                            <option value="90 %"
                                                                {{ $work_program->progress == '90 %' ? 'selected' : '' }}>
                                                                90 %</option>
                                                            <option value="100 %"
                                                                {{ $work_program->progress == '100 %' ? 'selected' : '' }}>
                                                                100 %</option>
                                                        </select>

                                                        @if ($errors->has('progress'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('progress') }}</p>
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
                                                                {{ $work_program->status == 1 ? 'selected' : '' }}>Aktif
                                                            </option>
                                                            <option value="2"
                                                                {{ $work_program->status == 2 ? 'selected' : '' }}>Tidak
                                                                Aktif</option>
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
                                                        <textarea rows="5" class="form-control summernote" id="description" name="description">{{ isset($work_program->description) ? $work_program->description : '' }}</textarea>
                                                        <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                                + Enter jika ingin pindah baris</small></p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions text-right">
                                                <a href="{{ route('backsite.work_program.index') }}" style="width:120px;"
                                                    class="btn bg-blue-grey text-white mr-1"
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('after-script')
    <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

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
    </script>
@endpush
