<?php

namespace App\Http\Controllers\Data\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Data\Hardware\DeviceMonitor\StoreDeviceMonitorRequest;
use App\Http\Requests\Data\Hardware\DeviceMonitor\UpdateDeviceMonitorRequest;
// use library here
use Illuminate\Support\Facades\Storage;

// use model here
use App\Models\Data\Hardware\DeviceMonitor;

class DeviceMonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
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
    public function store(StoreDeviceMonitorRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-monitor', $request->file('file')->getClientOriginalName());
        }

        // store to database
        $device_monitor = DeviceMonitor::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.device_hardware.index');
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
        $device_monitor = DeviceMonitor::find($decrypt_id);

        return view('pages.data.hardware.device-monitor.show', compact('device_monitor'));
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
        $device_monitor = DeviceMonitor::find($decrypt_id);

        return view('pages.data.hardware.device-monitor.edit', compact('device_monitor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeviceMonitorRequest $request, DeviceMonitor $device_monitor)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $device_monitor['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-monitor', $request->file('file')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }
        // update to database
        $device_monitor->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.device_hardware.index');
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
        $device_monitor = DeviceMonitor::find($decrypt_id);

        // cari old photo
        $path_file = $device_monitor['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $device_monitor->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
