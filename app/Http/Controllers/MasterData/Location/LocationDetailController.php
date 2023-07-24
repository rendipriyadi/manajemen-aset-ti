<?php

namespace App\Http\Controllers\MasterData\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Location\LocationDetail\StoreLocationDetailRequest;
use App\Http\Requests\MasterData\Location\LocationDetail\UpdateLocationDetailRequest;

// use model here
use App\Models\MasterData\Location\Location;
use App\Models\MasterData\Location\LocationDetail;
use App\Models\MasterData\Location\LocationRoom;
use App\Models\MasterData\Location\LocationSub;

class LocationDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location_detail = LocationDetail::all();
        $location = Location::orderBy('name', 'asc')->get();
        $location_sub = LocationSub::orderBy('name', 'asc')->get();
        $location_room = LocationRoom::orderBy('name', 'asc')->get();

        return view('pages.master-data.location.location_detail.index', compact('location_detail', 'location', 'location_sub', 'location_room'));
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
    public function store(StoreLocationDetailRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $location_detail = LocationDetail::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.location_detail.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $location_detail = LocationDetail::find($decrypt_id);

        return view('pages.master-data.location.location_detail.show', compact('location_detail'));
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
        $location_detail = LocationDetail::find($decrypt_id);

        $location = Location::orderBy('name', 'asc')->get();
        $location_sub = LocationSub::orderBy('name', 'asc')->get();
        $location_room = LocationRoom::orderBy('name', 'asc')->get();

        return view('pages.master-data.location.location_detail.edit', compact('location_detail', 'location', 'location_sub', 'location_room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationDetailRequest $request, LocationDetail $location_detail)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $location_detail->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.location_detail.index');
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
        $location_detail = LocationDetail::find($decrypt_id);

        // hapus location
        $location_detail->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
