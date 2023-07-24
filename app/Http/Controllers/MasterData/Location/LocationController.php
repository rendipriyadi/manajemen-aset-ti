<?php

namespace App\Http\Controllers\MasterData\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use libarary here
use App\Http\Requests\MasterData\Location\Location\StoreLocationRequest;
use App\Http\Requests\MasterData\Location\Location\UpdateLocationRequest;

// use model here
use App\Models\MasterData\Location\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location = Location::orderBy('name', 'asc')->get();

        return view('pages.master-data.location.location.index', compact('location'));
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
    public function store(StoreLocationRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $location = Location::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.location.index');
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
        $location = Location::find($decrypt_id);

        return view('pages.master-data.location.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $location->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.location.index');
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
        $location = Location::find($decrypt_id);

        // hapus location
        $location->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
