@extends('layouts.app')

{{-- set title --}}
@section('title', 'Device Hardware')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Device Hardware</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Device Hardware</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs nav-linetriangle">
                <li class="nav-item">
                    <a class="nav-link active" id="baseIcon-tab31" data-toggle="tab" aria-controls="tabIcon31"
                        href="#tabIcon31" aria-expanded="true"><i class="la la-server"></i> Device PC</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="baseIcon-tab32" data-toggle="tab" aria-controls="tabIcon32" href="#tabIcon32"
                        aria-expanded="false"><i class="la la-desktop"></i> Monitor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="baseIcon-tab33" data-toggle="tab" aria-controls="tabIcon33" href="#tabIcon33"
                        aria-expanded="false"><i class="la la-headphones"></i> Aksesoris</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="baseIcon-tab34" data-toggle="tab" aria-controls="tabIcon34" href="#tabIcon34"
                        aria-expanded="false"><i class="la la-laptop"></i> Perangkat Tambahan</a>
                </li>
            </ul>
            <div class="tab-content px-1 pt-1">
                <div role="tabpanel" class="tab-pane active" id="tabIcon31" aria-expanded="true"
                    aria-labelledby="baseIcon-tab31">
                    @include('pages.data.hardware.device-pc.index')
                </div>
                <div class="tab-pane" id="tabIcon32" aria-labelledby="baseIcon-tab32">
                    @include('pages.data.hardware.device-monitor.index')
                </div>
                <div class="tab-pane" id="tabIcon33" aria-labelledby="baseIcon-tab33">
                    @include('pages.data.hardware.device-additional.index')
                </div>
                <div class="tab-pane" id="tabIcon34" aria-labelledby="baseIcon-tab34">
                    @include('pages.data.hardware.device-more.index')
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="viewmodal" style="display: none;"></div>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #841dd8;
        }

        .nav-pills {
            display: flex;
            justify-content: center;
        }
    </style>
@endpush

@push('after-script')
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

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

        // Date Picker
        const fpDari = flatpickr('#dari', {
            altInput: true,
            altFormat: 'd F Y',
            dateFormat: 'Y-m-d',
            disableMobile: 'true',
        });

        // Date Picker
        const fpSampai = flatpickr('#sampai', {
            altInput: true,
            altFormat: 'd F Y',
            dateFormat: 'Y-m-d',
            disableMobile: 'true',
        });

        $(document).on('click', '#btnMinPc', function() {
            $(this).parents('tr').remove();
        });

        // create multiple input ip address more
        $("#btnPlusMore").click(function() {
            $("#tableMore").append(`
                <tr>
                    <td>
                        <input type="text" id="port" name="port[]" class="form-control" value="{{ old('port') }}" autocomplete="off">
                    </td>
                    <td>
                        <input type="text" id="ip_address" name="ip_address[]" class="form-control" value="{{ old('ip_address') }}" maxlength="15" autocomplete="off">
                    </td>
                    <td>
                        <input type="text" id="keterangan" name="keterangan[]" class="form-control" value="{{ old('keterangan') }}" autocomplete="off">
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

        function riwayatKerusakanPc(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('backsite.device_pc.form_kerusakan') }}",
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

        function riwayatKerusakanMore(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('backsite.device_more.form_kerusakan') }}",
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
