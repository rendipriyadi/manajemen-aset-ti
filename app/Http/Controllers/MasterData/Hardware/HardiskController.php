<?php

namespace App\Http\Controllers\MasterData\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Hardware\Hardisk\StoreHardiskRequest;
use App\Http\Requests\MasterData\Hardware\Hardisk\UpdateHardiskRequest;

// use model here
use App\Models\MasterData\Hardware\Hardisk;

class HardiskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hardisk = Hardisk::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.hardware.hardisk.index', compact('hardisk'));
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
    public function store(StoreHardiskRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $hardisk = Hardisk::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.hardisk.index');
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
        $hardisk = Hardisk::find($decrypt_id);

        return view('pages.master-data.hardware.hardisk.edit', compact('hardisk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHardiskRequest $request, Hardisk $hardisk)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $hardisk->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.hardisk.index');
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
        $hardisk = Hardisk::find($decrypt_id);

        // hapus location
        $hardisk->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
