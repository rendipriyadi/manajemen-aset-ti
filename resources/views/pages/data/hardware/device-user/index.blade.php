@extends('layouts.app')

{{-- set title --}}
@section('title', 'Device User')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Device User</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Device User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row ml-1 mb-2">
                <a href="{{ route('backsite.device_user.create') }}" class="btn btn-success text-white"></i>
                    Tambah Data</a>
            </div>
            <div class="row ml-1 mb-2">
                <form class="form" action="{{ route('backsite.device_user.export-pdf') }}" method="POST">

                    @csrf
                    <div class="form-group row">
                        <label class="col-md-1 label-control" for="dari">Dari </label>
                        <div class="col-md-4">
                            <input type="text" id="dari" name="dari" class="form-control"
                                value="{{ old('dari') }}" required />
                        </div>
                        <label class="col-md-1 label-control" for="sampai">Sampai </label>
                        <div class="col-md-4">
                            <input type="text" id="sampai" name="sampai" class="form-control"
                                value="{{ old('sampai') }}" required />
                        </div>
                        <div class="col-md-2">
                            <input type="submit" style="width:100px; height:40px" class="btn btn-danger"
                                value="Export PDF">
                        </div>
                    </div>
                </form>
            </div>

            {{-- table card --}}
            <div class="content-body">
                <section id="table-home">
                    <!-- Zero configuration table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">List User</h4>
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
                                                        <th style="text-align:center; width:20px;">No</th>
                                                        <th style="text-align:center;">QR code</th>
                                                        <th style="text-align:center;">User</th>
                                                        <th style="text-align:center;">PC</th>
                                                        <th style="text-align:center;">Monitor</th>
                                                        <th style="text-align:center;">Aksesoris</th>
                                                        <th style="text-align:center;">Lokasi</th>
                                                        <th style="text-align:center;">Status</th>
                                                        <th style="text-align:center; width:100px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($device_user as $key => $device_user_item)
                                                        <tr data-entry-id="{{ $device_user_item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $route = route('backsite.device_user.show-barcode', $device_user_item->id);
                                                                @endphp
                                                                {!! QrCode::size(100)->generate(url($route)) !!}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $device_user_item->employee->name ?? 'N/A' }} -
                                                                {{ $device_user_item->employee->division->name ?? 'N/A' }}
                                                            </td>
                                                            <td class="text-center"><span
                                                                    class="badge badge-success">{{ $device_user_item->device_pc->no_asset ?? 'N/A' }}</span>
                                                                - {{ $device_user_item->device_pc->name ?? 'N/A' }} -
                                                                {{ $device_user_item->device_pc->processor->name ?? 'N/A' }}
                                                            </td>
                                                            <td class="text-center">
                                                                @foreach (explode(',', $device_user_item->device_monitor_id) as $data_monitor)
                                                                    @php
                                                                        $spek_monitor = DB::table('device_monitor')
                                                                            ->where('id', $data_monitor)
                                                                            ->get();
                                                                    @endphp
                                                                    @foreach ($spek_monitor as $monitor)
                                                                        <span
                                                                            class="badge badge-success">{{ $monitor->no_asset ?? 'N/A' }}</span>
                                                                        - {{ $monitor->name }} ||
                                                                    @endforeach
                                                                @endforeach
                                                            </td>
                                                            <td class="text-center">
                                                                @foreach (explode(',', $device_user_item->device_additional_id) as $data_additional)
                                                                    @php
                                                                        $spek_additional = DB::table('device_additional')
                                                                            ->join('hardware_type_device', 'device_additional.type_device_id', '=', 'hardware_type_device.id')
                                                                            ->select('device_additional.*', 'hardware_type_device.name as name_type_device')
                                                                            ->where('device_additional.id', $data_additional)
                                                                            ->get();
                                                                    @endphp
                                                                    @foreach ($spek_additional as $additional)
                                                                        <span
                                                                            class="badge badge-success">{{ $additional->no_non_asset ?? 'N/A' }}</span>
                                                                        - {{ $additional->name_type_device }} -
                                                                        {{ $additional->name }} ||
                                                                    @endforeach
                                                                @endforeach
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $device_user_item->location->name ?? 'N/A' }}
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($device_user_item->status == 1)
                                                                    <span
                                                                        class="badge badge-info">{{ 'Aktif' }}</span>
                                                                @elseif($device_user_item->status == 2)
                                                                    <span
                                                                        class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
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
                                                                            data-remote="{{ route('backsite.device_user.show', encrypt($device_user_item->id)) }}"
                                                                            data-toggle="modal" data-target="#mymodal"
                                                                            data-title="Detail User"
                                                                            class="dropdown-item">
                                                                            Show
                                                                        </a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.device_user.edit', encrypt($device_user_item->id)) }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('backsite.device_user.destroy', encrypt($device_user_item->id)) }}"
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
                                                        <th>QR code</th>
                                                        <th>User</th>
                                                        <th>PC</th>
                                                        <th>Monitor</th>
                                                        <th>Aksesoris</th>
                                                        <th>Lokasi</th>
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

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}" />
@endpush

@push('after-script')
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
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
