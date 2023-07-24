<?php

namespace App\Http\Controllers\MasterData\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Hardware\TypeDevice\StoreTypeDeviceRequest;
use App\Http\Requests\MasterData\Hardware\TypeDevice\UpdateTypeDeviceRequest;

// use model here
use App\Models\MasterData\Hardware\TypeDevice;

class TypeDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_device = TypeDevice::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.hardware.type_device.index', compact('type_device'));
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
    public function store(StoreTypeDeviceRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $type_device = TypeDevice::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.type_device.index');
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
        $type_device = TypeDevice::find($decrypt_id);

        return view('pages.master-data.hardware.type_device.edit', compact('type_device'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeDeviceRequest $request, TypeDevice $type_device)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $type_device->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.type_device.index');
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
        $type_device = TypeDevice::find($decrypt_id);

        // hapus location
        $type_device->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
