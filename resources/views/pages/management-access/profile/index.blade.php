@extends('layouts.app')

{{-- set title --}}
@section('title', 'Profile')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Profile</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Profile</li>
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
                                        <form class="form form-horizontal" action="{{ route('backsite.profile.store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">Nama </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" id="name" name="name"
                                                            class="form-control"
                                                            value="{{ old('name', isset($user->name) ? $user->name : '') }}"
                                                            autocomplete="off" readonly>

                                                        @if ($errors->has('name'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="email">Nama </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" id="email" name="email"
                                                            class="form-control"
                                                            value="{{ old('email', isset($user->email) ? $user->email : '') }}"
                                                            autocomplete="off" readonly>

                                                        @if ($errors->has('email'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('email') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Type User</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" id="type_user_id" name="type_user_id"
                                                            class="form-control"
                                                            value="{{ old('type_user_id', isset($user->detail_user->type_user->name) ? $user->detail_user->type_user->name : '') }}"
                                                            autocomplete="off" readonly>

                                                        @if ($errors->has('type_user_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('type_user_id') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Job Position </label>
                                                    <div class="col-md-9 mx-auto">
                                                        @if ($user->detail_user->job_position == 1)
                                                            <span class="badge badge-success">{{ 'Manager' }}</span>
                                                        @elseif($user->detail_user->job_position == 2)
                                                            <span class="badge badge-cyan">{{ 'Kepala Departemen' }}</span>
                                                        @elseif($user->detail_user->job_position == 3)
                                                            <span class="badge badge-danger">{{ 'Administrasi' }}</span>
                                                        @elseif($user->detail_user->job_position == 4)
                                                            <span
                                                                class="badge badge-warning">{{ 'Hardware & Jaringan' }}</span>
                                                        @elseif($user->detail_user->job_position == 5)
                                                            <span
                                                                class="badge badge-secondary">{{ 'Peralatan Tol' }}</span>
                                                        @elseif($user->detail_user->job_position == 6)
                                                            <span class="badge badge-info">{{ 'Sistem Informasi' }}</span>
                                                        @else
                                                            <span>{{ 'N/A' }}</span>
                                                        @endif

                                                        @if ($errors->has('job_position'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('job_position') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="password_lama">Password
                                                        Lama <code style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="password" id="password_lama" name="password_lama"
                                                            class="form-control" placeholder="password lama"
                                                            value="{{ old('password_lama') }}">

                                                        @if ($errors->has('password_lama'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('password_lama') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="password_baru">Password
                                                        Baru <code style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="password" id="password_baru" name="password_baru"
                                                            class="form-control" placeholder="password baru"
                                                            value="{{ old('password_baru') }}">

                                                        @if ($errors->has('password_baru'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('password_baru') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="confirm_password">Confirm
                                                        New Password <code style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="password" id="confirm_password"
                                                            name="confirm_password" class="form-control"
                                                            placeholder="konfirmasi password baru"
                                                            value="{{ old('confirm_password') }}">

                                                        @if ($errors->has('confirm_password'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('confirm_password') }}</p>
                                                        @endif
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

        </div>
    </div>
    <!-- END: Content-->

@endsection
