<?php

namespace App\Http\Controllers\MasterData\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Hardware\Motherboard\StoreMotherboardRequest;
use App\Http\Requests\MasterData\Hardware\Motherboard\UpdateMotherboardRequest;

// use model here
use App\Models\MasterData\Hardware\Motherboard;

class MotherboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motherboard = Motherboard::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.hardware.motherboard.index', compact('motherboard'));
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
    public function store(StoreMotherboardRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $motherboard = Motherboard::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.motherboard.index');
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
        $motherboard = Motherboard::find($decrypt_id);

        return view('pages.master-data.hardware.motherboard.edit', compact('motherboard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMotherboardRequest $request, Motherboard $motherboard)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $motherboard->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.motherboard.index');
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
        $motherboard = Motherboard::find($decrypt_id);

        // hapus location
        $motherboard->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
