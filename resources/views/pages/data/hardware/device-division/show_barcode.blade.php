@extends('layouts.app')

{{-- set title --}}
@section('title', 'Data - Device User')

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
                    <h3 class="mb-0 content-header-title d-inline-block">Data Device Division</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Device Division</li>
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
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Divisi</th>
                                            <td>{{ $device_division->division->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Perangkat Tambahan</th>
                                            <td>
                                                @foreach (explode(',', $device_division->device_more_id) as $data_more)
                                                    @php
                                                        $spek_more = DB::table('device_more')
                                                            ->join('hardware_type_device', 'device_more.type_device_id', '=', 'hardware_type_device.id')
                                                            ->select('device_more.*', 'hardware_type_device.name as name_type_device')
                                                            ->where('device_more.id', $data_more)
                                                            ->get();
                                                    @endphp
                                                    @foreach ($spek_more as $more)
                                                        <span
                                                            class="badge badge-success">{{ $more->no_asset ?? 'N/A' }}</span>
                                                        - {{ $more->name_type_device ?? 'N/A' }} -
                                                        {{ $more->name ?? 'N/A ?>' }} ||
                                                    @endforeach
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td>
                                                {{ $device_division->location->name ?? 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>File</th>
                                            <td> <a data-fancybox="gallery"
                                                    data-src="{{ asset('storage/' . $device_division->file) }}"
                                                    class="blue accent-4 dropdown-item">Show</a></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($device_division->status == 1)
                                                    <span class="badge badge-info">{{ 'Aktif' }}</span>
                                                @elseif($device_division->status == 2)
                                                    <span class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                                @else
                                                    <span>{{ 'N/A' }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Deploy</th>
                                            <td>
                                                {{ Carbon\Carbon::parse($device_division->tgl_deploy)->translatedFormat('l, d F Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td>{!! isset($device_division->description) ? $device_division->description : 'N/A' !!}</td>
                                        </tr>
                                    </table>


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
