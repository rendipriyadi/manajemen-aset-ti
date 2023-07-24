<?php

namespace App\Http\Controllers\MasterData\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Hardware\Ram\StoreRamRequest;
use App\Http\Requests\MasterData\Hardware\Ram\UpdateRamRequest;

// use model here
use App\Models\MasterData\Hardware\Ram;

class RamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ram = Ram::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.hardware.ram.index', compact('ram'));
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
    public function store(StoreRamRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $ram = Ram::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.ram.index');
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
        $ram = Ram::find($decrypt_id);

        return view('pages.master-data.hardware.ram.edit', compact('ram'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRamRequest $request, Ram $ram)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $ram->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.ram.index');
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
        $ram = Ram::find($decrypt_id);

        // hapus location
        $ram->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
