<?php

namespace App\Http\Controllers\Data\Hardware;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// request
use Illuminate\Support\Facades\Storage;
use App\Models\Data\Hardware\DeviceMore;

// use library here
use Barryvdh\Snappy\Facades\SnappyPdf;


// use model here
use App\Models\MasterData\Hardware\TypeDevice;
use App\Models\Data\Hardware\TroubleshootDeviceMore;
use App\Http\Requests\Data\Hardware\StoreExportPdfRequest;
use App\Http\Requests\Data\Hardware\DeviceMore\StoreDeviceMoreRequest;
use App\Http\Requests\Data\Hardware\DeviceMore\UpdateDeviceMoreRequest;
use App\Http\Requests\Data\Hardware\TroubleshootDeviceMore\StoreTroubleshootDeviceMoreRequest;

class DeviceMoreController extends Controller
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
    public function store(StoreDeviceMoreRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-more', $request->file('file')->getClientOriginalName());
        }

        // store to database
        $device_more = DeviceMore::create($data);

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
        $device_more = DeviceMore::find($decrypt_id);

        $troubleshoot_device_more = TroubleshootDeviceMore::where('device_more_id', $device_more['id'])->get();

        return view('pages.data.hardware.device-more.show', compact('device_more', 'troubleshoot_device_more'));
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
        $device_more = DeviceMore::find($decrypt_id);

        // consumables
        $consumables = TypeDevice::where('category', 'Perangkat Tambahan')->orderby('name', 'asc')->get();

        return view('pages.data.hardware.device-more.edit', compact('device_more', 'consumables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeviceMoreRequest $request, DeviceMore $device_more)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $device_more['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-more', $request->file('file')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }
        // update to database
        $device_more->update($data);

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
        $device_more = DeviceMore::find($decrypt_id);

        // cari old photo
        $path_file =  $device_more['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $device_more->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // get form riwayat kerusakan
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = DeviceMore::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.data.hardware.device-more.form_kerusakan', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // simpan data riwayat kerusakan
    public function upload(StoreTroubleshootDeviceMoreRequest $request)
    {
        $data = $request->all();
        // store to database
        $troubleshoot_pc = TroubleshootDeviceMore::create($data);

        alert()->success('Sukses', 'Data Berhasil ditambahkan');
        return redirect()->route('backsite.device_hardware.index');
    }

    // export pdf
    public function printPdf(StoreExportPdfRequest $request)
    {
        $dari_tgl = $request->dari;
        $sampai_tgl = $request->sampai;

        // cari troubleshoot pc
        $troubleshoot_device_more = TroubleshootDeviceMore::where('tgl_perbaikan', '>=', $dari_tgl)->where('tgl_perbaikan', '<=', $sampai_tgl)->get();

        $pdf = SnappyPdf::loadView('pages.laporan.laporan-kerusakan-perangkat-tambahan', [
            'troubleshoot_device_more' => $troubleshoot_device_more,
            'dari_tgl' => $dari_tgl,
            'sampai_tgl' => $sampai_tgl
        ]);
        $pdf->setOption('page-size', 'A4');
        $pdf->setOption('margin-bottom', '10mm');
        $pdf->setOption('enable-local-file-access', true);

        // Generate PDF and display in the browser
        return $pdf->stream('laporan-kerusakan-perangkat-tambahan.pdf');
    }
}
