@extends('layouts.app')

{{-- set title --}}
@section('title', 'Aktivitas Harian')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Aktivitas Harian</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Aktivitas Harian</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- add card --}}
            <div class="content-body">
                <section id="add-home">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <a data-action="collapse">
                                        <h4 class="card-title text-white">Tambah Data</h4>
                                        <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
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

                                        <form class="form form-horizontal"
                                            action="{{ route('backsite.daily_activity.store') }}" method="POST"
                                            enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                                </div>

                                                <input type="hidden" id="executor" name="executor"
                                                    value="{{ isset($user_id) ? $user_id : '' }}">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="executor">Pelaksana
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="executor" class="form-control"
                                                            value="{{ isset($executor) ? $executor : '' }}" readonly>

                                                        @if ($errors->has('executor'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('executor') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="work_category_id">Kategori
                                                        Pekerjaan <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="work_category_id" id="work_category_id"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            @foreach ($work_category as $key => $work_category_item)
                                                                <option value="{{ $work_category_item->id }}">
                                                                    {{ $work_category_item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('work_category_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('work_category_id') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="users_id">Pendamping <code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <select name="users_id" id="users_id" class="form-control select2">
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            @foreach ($user as $key => $user_item)
                                                                <option value="{{ $user_item->id }}">
                                                                    {{ $user_item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('users_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('users_id') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="work_type_id">Jenis
                                                        Pekerjaan <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="work_type_id" id="work_type_id"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            @foreach ($work_type as $key => $work_type_item)
                                                                <option value="{{ $work_type_item->id }}">
                                                                    {{ $work_type_item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('work_type_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('work_type_id') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="start_date">Tanggal Mulai
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="datetime-local" id="start_date" name="start_date"
                                                            class="form-control" value="{{ old('start_date') }}" required>

                                                        @if ($errors->has('start_date'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('start_date') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="finish_date">Tanggal
                                                        Selesai
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="datetime-local" id="finish_date" name="finish_date"
                                                            class="form-control" value="{{ old('finish_date') }}">

                                                        @if ($errors->has('finish_date'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('finish_date') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="status">Status<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <select name="status" id="status"
                                                            class="form-control select2">
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
                                                    <label class="col-md-2 label-control" for="location_room_id">Lokasi
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <select name="location_room_id" id="location_room_id"
                                                            class="form-control select2">
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            @foreach ($location_room as $key => $location_room_item)
                                                                <option value="{{ $location_room_item->id }}">
                                                                    {{ $location_room_item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('location_room_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('location_room_id') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="activity">Kegiatan<code
                                                            style="color:red;">reqired</code></label>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" class="form-control summernote" id="activity" name="activity" required></textarea>
                                                        <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                                + Enter jika ingin pindah baris</small></p>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="description">Catatan<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" class="form-control summernote" id="description" name="description"></textarea>
                                                        <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                                + Enter jika ingin pindah baris</small></p>
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
                                    <h4 class="card-title">List Aktivitas Harian</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
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
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Pelaksana</th>
                                                        <th class="text-center">Tgl Mulai</th>
                                                        <th class="text-center">kategori Pekerjaan</th>
                                                        <th class="text-center">Jenis Pekerjaan</th>
                                                        <th class="text-center">Kegiatan</th>
                                                        <th class="text-center">Tgl Selesai</th>
                                                        <th class="text-center">Status</th>
                                                        <th style="text-align:center; width:150px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($daily_activity as $key => $daily_activity_item)
                                                        <tr data-entry-id="{{ $daily_activity_item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center">
                                                                {{ $daily_activity_item->detail_user->user->name ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ date('d-m-y H:i', strtotime($daily_activity_item->start_date)) ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $daily_activity_item->work_category->name ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $daily_activity_item->work_type->name ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {!! $daily_activity_item->activity ?? '' !!}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ date('d-m-y H:i', strtotime($daily_activity_item->finish_date)) ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($daily_activity_item->status == 1)
                                                                    <span
                                                                        class="badge badge-success">{{ 'Aktif' }}</span>
                                                                @elseif($daily_activity_item->status == 2)
                                                                    <span
                                                                        class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                                                @else
                                                                    <span>{{ 'N/A' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    <button type="button"
                                                                        class="btn btn-cyan btn-sm mr-1"
                                                                        title="Tambah File"
                                                                        onclick="upload('{{ $daily_activity_item->id }}')"><i
                                                                            class="bx bx-file"></i></button>
                                                                    <button type="button"
                                                                        class="btn btn-info btn-sm dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu"
                                                                        aria-labelledby="btnGroupDrop2">
                                                                        <a href="#mymodal"
                                                                            data-remote="{{ route('backsite.daily_activity.show', encrypt($daily_activity_item->id)) }}"
                                                                            data-toggle="modal" data-target="#mymodal"
                                                                            data-title="Detail Aktivitas Harian"
                                                                            class="dropdown-item">
                                                                            Show
                                                                        </a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.daily_activity.edit', encrypt($daily_activity_item->id)) }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('backsite.daily_activity.destroy', encrypt($daily_activity_item->id)) }}"
                                                                            method="POST"
                                                                            onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                            <input type="hidden" name="_method"
                                                                                value="DELETE">
                                                                            <input type="hidden" name="_token"
                                                                                value="{{ csrf_token() }}">
                                                                            <input type="submit" class="dropdown-item"
                                                                                value="Delete">
                                                                        </form>
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
                                                        <th>Pelaksana</th>
                                                        <th>Tgl Mulai</th>
                                                        <th>kategori Pekerjaan</th>
                                                        <th>Jenis Pekerjaan</th>
                                                        <th>Kegiatan</th>
                                                        <th>Tgl Selesai</th>
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

        </div>
    </div>
    <!-- END: Content-->
    <div class="viewmodal" style="display: none;"></div>

@endsection

@push('after-style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">
@endpush

@push('after-script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript">
    </script>

    <script>
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });
        });

        $('.default-table').DataTable({
            "order": [],
            "paging": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "pageLength": 10
        });

        // fancybox
        Fancybox.bind('[data-fancybox="gallery"]', {
            infinite: false
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

        // test caseman
        // function link() {
        //     let windowPopUp = window.open('http://google.com', "Test Page", "width=800,height=800");

        //     windowPopUp.focus();
        // }

        function upload(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('backsite.daily_activity.form_upload') }}",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalupload').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    </script>

    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa spin"></i>
                </div>
            </div>
        </div>
    </div>
@endpush
