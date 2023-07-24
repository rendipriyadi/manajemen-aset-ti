<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\ManagementAccess\TypeUser\StoreTypeUserRequest;
use App\Http\Requests\ManagementAccess\TypeUser\UpdateTypeUserRequest;

// use model here
use App\Models\ManagementAccess\TypeUser;

class TypeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_user = TypeUser::where('name', '!=', 'Admin')->orderBy('name', 'asc')->get();

        return view('pages.management-access.type-user.index', compact('type_user'));
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
    public function store(StoreTypeUserRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $type_user = TypeUser::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.type_user.index');
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
        $type_user = TypeUser::find($decrypt_id);

        return view('pages.management-access.type-user.edit', compact('type_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeUserRequest $request, TypeUser $type_user)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $type_user->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.type_user.index');
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
        $type_user = TypeUser::find($decrypt_id);

        // hapus daily activity
        $type_user->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
