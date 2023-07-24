<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use library here
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

// request
use App\Http\Requests\ManagementAccess\User\StoreUserRequest;
use App\Http\Requests\ManagementAccess\User\UpdateUserRequest;

// use model here
use App\Models\User;
use App\Models\ManagementAccess\DetailUser;
use App\Models\ManagementAccess\TypeUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('name', '!=', 'Administrator')->orderBy('name', 'asc')->get();
        $type_user = TypeUser::where('name', '!=', 'Admin')->orderBy('name', 'asc')->get();

        return view('pages.management-access.user.index', compact('user', 'type_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // hash password
        $data['password'] = Hash::make($data['password']);

        // store to database
        $user = User::create($data);
        $id = $user['id'];

        // save to detail user , to set type user
        $detail_user = new DetailUser;
        // upload icon
        if ($request->hasFile('icon')) {
            $detail_user->icon = $request->file('icon')->storeAs('assets/icon-user', $id . '-' . $request->file('icon')->getClientOriginalName());
        }

        $detail_user->user_id = $user['id'];
        $detail_user->type_user_id = $request['type_user_id'];
        $detail_user->job_position = $request['job_position'];
        $detail_user->status = $request['status'];
        $detail_user->save();

        alert()->success('Sukses', 'User berhasil ditambahkan');
        return redirect()->route('backsite.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $user = User::find($decrypt_id);

        $type_user = TypeUser::where('name', '!=', 'Admin')->orderBy('name', 'asc')->get();

        return view('pages.management-access.user.edit', compact('user', 'type_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // get all request from frontsite
        $data = $request->all();
        $id = $user->id;

        // get data 
        $path_icon = $user->detail_user->icon;

        // cek ada update password atau tidak
        if ($request->password != null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        // update to database
        $user->update($data);

        // save to detail user , to set type user
        $detail_user = DetailUser::find($user['id']);
        // upload process here
        // upload icon
        if ($request->hasFile('icon')) {
            $detail_user->icon = $request->file('icon')->storeAs('assets/icon-user', $id . '-' . $request->file('icon')->getClientOriginalName());
            // hapus file
            if ($path_icon != null || $path_icon != '') {
                Storage::delete($path_icon);
            }
        } else {
            $detail_user->icon = $path_icon;
        }
        $detail_user->type_user_id = $request['type_user_id'];
        $detail_user->job_position = $request['job_position'];
        $detail_user->status = $request['status'];
        $detail_user->save();

        alert()->success('Sukses', 'User berhasil diupdate');
        return redirect()->route('backsite.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $user = User::find($decrypt_id);

        // hapus user
        $user->forceDelete();

        // Hapus Detail User
        $detail_user = DetailUser::find($user['id']);
        // cari old icon
        $path_icon = $detail_user['icon'];
        // hapus icon
        if ($path_icon != null || $path_icon != '') {
            Storage::delete($path_icon);
        }

        $detail_user->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
