@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Ip Address')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Ip Address</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Ip Address</li>
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
                                        <div class="card-text">
                                            <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                        </div>
                                        <form class="form form-horizontal"
                                            action="{{ route('backsite.ip_address.update', [$ip_address->id]) }}"
                                            method="POST" enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">


                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="division_id">Divisi <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="division_id" id="division_id"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            @foreach ($division as $key => $division_item)
                                                                <option value="{{ $division_item->id }}"
                                                                    {{ $division_item->id == $ip_address->division_id ? 'selected' : '' }}>
                                                                    {{ $division_item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('division_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('division_id') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">Ip Address Awal
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" id="start_ip" name="start_ip"
                                                            class="form-control" placeholder="example 200.200.200.200"
                                                            value="{{ old('start_ip', isset($ip_address->start_ip) ? $ip_address->start_ip : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('start_ip'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('start_ip') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">Ip Address Akhir
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" id="end_ip" name="end_ip"
                                                            class="form-control" placeholder="example 200.200.200.200"
                                                            value="{{ old('end_ip', isset($ip_address->end_ip) ? $ip_address->end_ip : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('end_ip'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('end_ip') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="description">Keterangan<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <textarea rows="3" class="form-control" id="description" name="description">{{ isset($ip_address->description) ? $ip_address->description : '' }}</textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions text-right">
                                                <a href="{{ route('backsite.ip_address.index') }}" style="width:120px;"
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
