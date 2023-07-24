<?php

namespace App\Http\Controllers\MasterData\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Location\LocationRoom\StoreLocationRoomRequest;
use App\Http\Requests\MasterData\Location\LocationRoom\UpdateLocationRoomRequest;

// use model here
use App\Models\MasterData\Location\LocationRoom;

class LocationRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location_room = LocationRoom::orderBy('name', 'asc')->get();

        return view('pages.master-data.location.location_room.index', compact('location_room'));
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
    public function store(StoreLocationRoomRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $location_room = LocationRoom::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.location_room.index');
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
        $location_room = LocationRoom::find($decrypt_id);

        return view('pages.master-data.location.location_room.edit', compact('location_room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRoomRequest $request, LocationRoom $location_room)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $location_room->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.location_room.index');
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
        $location_room = LocationRoom::find($decrypt_id);

        // hapus location
        $location_room->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
