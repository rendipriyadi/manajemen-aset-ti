<?php

namespace App\Http\Controllers\Data\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use library here
use Illuminate\Support\Facades\DB;

// use model here
use App\Models\Data\Hardware\DeviceAdditional;
use App\Models\Data\Hardware\DeviceMonitor;
use App\Models\Data\Hardware\DeviceMore;
use App\Models\Data\Hardware\DevicePc;
use App\Models\MasterData\Hardware\Hardisk;
use App\Models\MasterData\Hardware\Motherboard;
use App\Models\MasterData\Hardware\Processor;
use App\Models\MasterData\Hardware\Ram;
use App\Models\MasterData\Hardware\TypeDevice;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // device_pc
        $device_pc = DevicePc::orderby('created_at', 'desc')->get();
        $motherboard = Motherboard::orderby('name', 'asc')->get();
        $processor = Processor::orderby('name', 'asc')->get();
        $ram = Ram::orderby('name', 'asc')->get();
        $hardisk = Hardisk::orderby('name', 'asc')->get();

        // device_monitor
        $device_monitor = DeviceMonitor::orderby('created_at', 'desc')->get();

        // device_additional
        $device_additional = DeviceAdditional::orderby('created_at', 'desc')->get();

        // create no_non_asset
        $q = DB::table('device_additional')->select(DB::raw('MAX(RIGHT(no_non_asset, 6)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }

        // device_more
        $device_more = DeviceMore::orderby('created_at', 'desc')->get();
        $accessories = TypeDevice::where('category', 'Aksesoris')->orderby('name', 'asc')->get();
        $consumables = TypeDevice::where('category', 'Perangkat Tambahan')->orderby('name', 'asc')->get();

        return view('pages.data.hardware.device.index', compact('device_pc', 'motherboard', 'processor', 'ram', 'hardisk', 'device_monitor', 'device_additional', 'kd', 'device_more', 'accessories', 'consumables'));
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
    public function store(Request $request)
    {
        return abort(404);
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
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }
}
