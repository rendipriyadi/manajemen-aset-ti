<?php

namespace App\Http\Controllers\MasterData\Network;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Network\StoreIpAddressRequest;
use App\Http\Requests\MasterData\Network\UpdateIpAddressRequest;

// model
use App\Models\MasterData\Division\Division;
use App\Models\MasterData\Network\IpAddress;

class IpAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $division = Division::orderBy('name', 'asc')->get();
        $ip_address = IpAddress::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.network.ip_address.index', compact('division', 'ip_address'));
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
    public function store(StoreIpAddressRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $ip_address = IpAddress::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.ip_address.index');
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
        $ip_address = IpAddress::find($decrypt_id);
        $division = Division::orderBy('name', 'asc')->get();

        return view('pages.master-data.network.ip_address.edit', compact('division', 'ip_address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIpAddressRequest $request, IpAddress $ip_address)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $ip_address->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.ip_address.index');
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
        $ip_address = IpAddress::find($decrypt_id);

        // hapus department
        $ip_address->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
