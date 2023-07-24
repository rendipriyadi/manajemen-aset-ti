<?php

namespace App\Http\Controllers\MasterData\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Location\LocationSub\StoreLocationSubRequest;
use App\Http\Requests\MasterData\Location\LocationSub\UpdateLocationSubRequest;

// use model here
use App\Models\MasterData\Location\LocationSub;

class LocationSubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location_sub = LocationSub::orderBy('name', 'asc')->get();

        return view('pages.master-data.location.location_sub.index', compact('location_sub'));
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
    public function store(StoreLocationSubRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $location_sub = LocationSub::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.location_sub.index');
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
        $location_sub = LocationSub::find($decrypt_id);

        return view('pages.master-data.location.location_sub.edit', compact('location_sub'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationSubRequest $request, LocationSub $location_sub)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $location_sub->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.location_sub.index');
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
        $location_sub = LocationSub::find($decrypt_id);

        // hapus location
        $location_sub->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
