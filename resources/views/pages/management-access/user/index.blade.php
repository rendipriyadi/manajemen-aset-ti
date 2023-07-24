@extends('layouts.app')

{{-- set title --}}
@section('title', 'User')

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
                    <h3 class="content-header-title mb-0 d-inline-block">User</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">User</li>
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

                                        <form class="form form-horizontal" action="{{ route('backsite.user.store') }}"
                                            method="POST" enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">Nama <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" id="name" name="name"
                                                            class="form-control" placeholder="example John Doe or Jane"
                                                            value="{{ old('name') }}" autocomplete="off" required>

                                                        @if ($errors->has('name'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="email">E-mail <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="email" id="email" name="email"
                                                            class="form-control" placeholder="example@mail.com"
                                                            value="{{ old('email') }}" autocomplete="off" required>

                                                        @if ($errors->has('email'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('email') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">Password <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="password" id="password" name="password"
                                                            class="form-control" placeholder="example John Doe or Jane"
                                                            value="{{ old('password') }}" required>

                                                        @if ($errors->has('password'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('password') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Type User <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="type_user_id" id="type_user_id"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>Choose
                                                            </option>
                                                            @foreach ($type_user as $key => $type_user_item)
                                                                <option value="{{ $type_user_item->id }}">
                                                                    {{ $type_user_item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('type_user_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('type_user_id') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="hasil">Job Position
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="job_position" id="job_position"
                                                            class="form-control select2">
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="1">Manajer</option>
                                                            <option value="2">Kepala Departemen</option>
                                                            <option value="3">Administrasi</option>
                                                            <option value="4">Hardware & Jaringan</option>
                                                            <option value="5">Peralatan Tol</option>
                                                            <option value="6">Sistem Informasi</option>
                                                            <option value="7">Senior Officer</option>
                                                        </select>

                                                        @if ($errors->has('job_position'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('job_position') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="status">Status
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
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
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="icon">Upload Icon
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="icon" name="icon">
                                                            <label class="custom-file-label" for="file"
                                                                aria-describedby="file">Pilih
                                                                Icon</label>
                                                        </div>
                                                        <p class="text-muted"><small class="text-danger">Hanya dapat
                                                                mengunggah 1 Icon</small></p>

                                                        @if ($errors->has('icon'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('icon') }}</p>
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

            {{-- table card --}}
            <div class="content-body">
                <section id="table-home">
                    <!-- Zero configuration table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">User List</h4>
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
                                                        <th style="text-align:center; width:50px;">No</th>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center">Email</th>
                                                        <th class="text-center">Type User</th>
                                                        <th class="text-center">Job Position</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Icon</th>
                                                        <th style="text-align:center; width:150px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($user as $key => $user_item)
                                                        <tr data-entry-id="{{ $user_item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center">{{ $user_item->name ?? '' }}</td>
                                                            <td class="text-center">{{ $user_item->email ?? '' }}</td>
                                                            <td class="text-center">
                                                                <span
                                                                    class="badge bg-success mr-1 mb-1">{{ $user_item->detail_user->type_user->name ?? '' }}</span>
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($user_item->detail_user->job_position == 1)
                                                                    <span
                                                                        class="badge badge-success">{{ 'Manager' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 2)
                                                                    <span
                                                                        class="badge badge-cyan">{{ 'Kepala Departemen' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 3)
                                                                    <span
                                                                        class="badge badge-danger">{{ 'Administrasi' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 4)
                                                                    <span
                                                                        class="badge badge-warning">{{ 'Hardware & Jaringan' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 5)
                                                                    <span
                                                                        class="badge badge-secondary">{{ 'Peralatan Tol' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 6)
                                                                    <span
                                                                        class="badge badge-info">{{ 'Sistem Informasi' }}</span>
                                                                @elseif($user_item->detail_user->job_position == 7)
                                                                    <span
                                                                        class="badge badge-primary">{{ 'Senior Officer' }}</span>
                                                                @else
                                                                    <span>{{ 'N/A' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($user_item->detail_user->status == 1)
                                                                    <span
                                                                        class="badge badge-success">{{ 'Aktif' }}</span>
                                                                @elseif($user_item->detail_user->status == 2)
                                                                    <span
                                                                        class="badge badge-danger">{{ 'Tidak Aktif' }}</span>
                                                                @else
                                                                    <span>{{ 'N/A' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center"><img
                                                                    src="{{ asset('storage/' . $user_item->detail_user->icon) }}"
                                                                    alt="Icon User" width="50px">
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    <button type="button"
                                                                        class="btn btn-info btn-sm dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.user.edit', encrypt($user_item->id)) }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('backsite.user.destroy', encrypt($user_item->id)) }}"
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
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Type User</th>
                                                        <th>Job Position</th>
                                                        <th>Status</th>
                                                        <th>Icon</th>
                                                        <th style="text-align:center; width:150px;">Action</th>
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

@push('after-script')
    <script>
        $('.default-table').DataTable({
            "order": [],
            "paging": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "pageLength": 10
        });
    </script>
@endpush
