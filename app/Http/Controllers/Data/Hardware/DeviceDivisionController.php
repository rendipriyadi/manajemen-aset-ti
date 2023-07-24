<?php

namespace App\Http\Controllers\Data\Hardware;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

// request
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

// use model here
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Data\Hardware\DeviceMore;

// use library here
use App\Models\Data\Hardware\DeviceDivision;
use App\Models\MasterData\Division\Division;
use App\Models\MasterData\Location\LocationDetail;
use App\Http\Requests\Data\Hardware\StoreExportPdfRequest;
use App\Http\Requests\Data\Hardware\DeviceDivision\StoreDeviceDivisionRequest;
use App\Http\Requests\Data\Hardware\DeviceDivision\UpdateDeviceDivisionRequest;

class DeviceDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $device_division = DeviceDivision::all();

        return view('pages.data.hardware.device-division.index', compact('device_division'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $device_more = DeviceMore::where('status', 1)->orderby('no_asset', 'asc')->get();
        $division = Division::orderby('name', 'asc')->get();
        $location_detail = LocationDetail::orderby('location_room_id', 'asc')->get();

        return view('pages.data.hardware.device-division.create', compact('device_more', 'division', 'location_detail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeviceDivisionRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // update device_more
        DeviceMore::whereIn('id', $data['device_more_id'])->update(['status' => '2']);

        // process implode
        $data['device_more_id'] = implode(',', $request['device_more_id']);

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-division', $request->file('file')->getClientOriginalName());
        }

        // store to database
        $device_division = DeviceDivision::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.device_division.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // decrypt_id
        $decrypt_id = decrypt($id);
        $device_division = DeviceDivision::find($decrypt_id);

        return view('pages.data.hardware.device-division.show', compact('device_division'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // decrypt_id
        $decrypt_id = decrypt($id);
        $device_division = DeviceDivision::find($decrypt_id);

        $device_more = DeviceMore::orderby('no_asset', 'asc')->get();
        $division = Division::orderby('name', 'asc')->get();
        $location_detail = LocationDetail::orderby('location_room_id', 'asc')->get();

        return view('pages.data.hardware.device-division.edit', compact('device_division', 'device_more', 'division', 'location_detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeviceDivisionRequest $request, DeviceDivision $device_division)
    {
        // get all request from frontsite
        $data = $request->all();

        // set semua status device ke status == 1
        // update device_more
        $data_more = explode(',', $device_division['device_more_id']);
        DeviceMore::whereIn('id', $data_more)->update(['status' => '1']);

        // update semua status device == 2
        // update device_more
        DeviceMore::whereIn('id', $data['device_more_id'])->update(['status' => '2']);

        // cek status aktif/tidak aktif
        if ($data['status'] == 2) {
            // update device_more
            DeviceMore::whereIn('id', $data['device_more_id'])->update(['status' => '1']);
        }

        // process implode
        $data['device_more_id'] = implode(',', $request['device_more_id']);

        // cari old photo
        $path_file = $device_division['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-division', $request->file('file')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }

        // update to database
        $device_division->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.device_division.index');
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
        $device_division = DeviceDivision::find($decrypt_id);

        // update device_more
        $data_more = explode(',', $device_division['device_more_id']);
        DeviceMore::whereIn('id', $data_more)->update(['status' => '1']);

        // cari old photo
        $path_file = $device_division['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus device user
        $device_division->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function show_barcode($id)
    {
        $device_division = DeviceDivision::find($id);

        return view('pages.data.hardware.device-division.show_barcode', compact('device_division'));
    }

    // export pdf
    public function printPdf(StoreExportPdfRequest $request)
    {
        $dari_tgl = $request->dari;
        $sampai_tgl = $request->sampai;

        // cari troubleshoot pc
        // cari troubleshoot pc
        $device_division = DeviceDivision::where('tgl_deploy', '>=', $dari_tgl)
            ->where('tgl_deploy', '<=', $sampai_tgl)
            ->orderby('tgl_deploy', 'asc')
            ->get();

        $pdf = SnappyPdf::loadView('pages.laporan.laporan-aset-divisi', [
            'device_division' => $device_division,
            'dari_tgl' => $dari_tgl,
            'sampai_tgl' => $sampai_tgl
        ]);
        $pdf->setOption('page-size', 'A4');
        $pdf->setOption('margin-bottom', '10mm');
        $pdf->setOption('enable-local-file-access', true);

        // Generate PDF and display in the browser
        return $pdf->stream('laporan-aset-divisi.pdf');
    }
}
