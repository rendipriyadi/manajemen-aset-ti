<?php

namespace App\Http\Controllers\Data\Hardware;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// request
use App\Models\Data\Hardware\DevicePc;
use App\Models\MasterData\Hardware\Ram;

// use library here
use Illuminate\Support\Facades\Storage;
use Barryvdh\Snappy\Facades\SnappyPdf;

// use model here
use App\Models\Data\Hardware\IpAddressPc;
use App\Models\MasterData\Hardware\Hardisk;
use App\Models\Data\Hardware\TroubleshootPC;
use App\Models\MasterData\Hardware\Processor;
use App\Models\MasterData\Hardware\Motherboard;
use App\Http\Requests\Data\Hardware\DevicePc\StoreDevicePcRequest;
use App\Http\Requests\Data\Hardware\DevicePc\UpdateDevicePcRequest;
use App\Http\Requests\Data\Hardware\StoreExportPdfRequest;
use App\Http\Requests\Data\Hardware\TroubleshootPc\StoreTroubleshootPCRequest;

class DevicePcController extends Controller
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
    public function store(StoreDevicePcRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-pc', $request->file('file')->getClientOriginalName());
        }

        // process implode
        $data['hardisk_id'] = implode(',', $request['hardisk_id']);
        $data['ram_id'] = implode(',', $request['ram_id']);

        // store to database
        $device_pc = DevicePc::create($data);

        // save to ip_address_pc
        foreach ($request->ip_address  as $key => $ip_address) {
            $data_ip = [
                'device_pc_id' =>   $device_pc['id'],
                'port' => $request->port[$key],
                'ip_address' => $ip_address,
                'keterangan' => $request->keterangan[$key]
            ];
            IpAddressPc::create($data_ip);
        }

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
        $device_pc = DevicePc::find($decrypt_id);

        $ip_address = IpAddressPc::where('device_pc_id', $device_pc['id'])->get();
        $troubleshoot_pc = TroubleshootPC::where('device_pc_id', $device_pc['id'])->get();

        return view('pages.data.hardware.device-pc.show', compact('device_pc', 'ip_address', 'troubleshoot_pc'));
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
        $device_pc = DevicePc::find($decrypt_id);

        // device_pc
        $motherboard = Motherboard::orderby('name', 'asc')->get();
        $processor = Processor::orderby('name', 'asc')->get();
        $ram = Ram::orderby('name', 'asc')->get();
        $hardisk = Hardisk::orderby('name', 'asc')->get();

        // ip_address_pc
        $ip_address = IpAddressPc::where('device_pc_id', $device_pc['id'])->get();

        return view('pages.data.hardware.device-pc.edit', compact('device_pc', 'motherboard', 'processor', 'ram', 'hardisk', 'ip_address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDevicePcRequest $request, DevicePc $device_pc)
    {
        // get all request from frontsite
        $data = $request->all();

        // cari old photo
        $path_file = $device_pc['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-pc', $request->file('file')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }

        // process implode
        $data['hardisk_id'] = implode(',', $request['hardisk_id']);
        $data['ram_id'] = implode(',', $request['ram_id']);

        // update to database
        $device_pc->update($data);

        // update ip_address_pc
        if ($request->ip_address) {
            foreach ($request->ip_address as $key => $pc) {
                $ip = IpAddressPc::find($request->id[$key]);
                $ip->port = $request->port[$key];
                $ip->ip_address = $pc;
                $ip->keterangan = $request->keterangan[$key];
                $ip->save();
            }
        }

        // save to ip_address_pc
        if ($request->address_ip) {
            foreach ($request->address_ip  as $key => $ip_address) {
                $data_ip = [
                    'device_pc_id' =>   $device_pc['id'],
                    'port' => $request->port_ip[$key],
                    'ip_address' => $ip_address,
                    'keterangan' => $request->keterangan_ip[$key]
                ];
                IpAddressPc::create($data_ip);
            }
        }

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
        $device_pc = DevicePc::find($decrypt_id);

        // cari old photo
        $path_file = $device_pc['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus location
        $device_pc->forceDelete();

        // delete data ip_address_pc
        $ip_address = IpAddressPc::where('device_pc_id', $decrypt_id)->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // hapus ip_device_pc
    public function delete_ip(Request $request)
    {
        $ip_address = IpAddressPc::find($request->id);

        $ip_address->forceDelete();

        $msg = [
            'sukses' => 'Data berhasil dihapus'
        ];

        return response()->json($msg);
    }

    // get form riwayat kerusakan
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = DevicePc::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.data.hardware.device-pc.form_kerusakan', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // simpan data riwayat kerusakan
    public function upload(StoreTroubleshootPCRequest $request)
    {
        $data = $request->all();
        // store to database
        $troubleshoot_pc = TroubleshootPC::create($data);

        alert()->success('Sukses', 'Data Berhasil ditambahkan');
        return redirect()->route('backsite.device_hardware.index');
    }

    // export pdf
    public function printPdf(StoreExportPdfRequest $request)
    {
        $dari_tgl = $request->dari;
        $sampai_tgl = $request->sampai;

        // cari troubleshoot pc
        $troubleshoot_pc = TroubleshootPC::where('tgl_perbaikan', '>=', $dari_tgl)->where('tgl_perbaikan', '<=', $sampai_tgl)->get();

        $pdf = SnappyPdf::loadView('pages.laporan.laporan-kerusakan-pc', [
            'troubleshoot_pc' => $troubleshoot_pc,
            'dari_tgl' => $dari_tgl,
            'sampai_tgl' => $sampai_tgl
        ]);
        $pdf->setOption('page-size', 'A4');
        $pdf->setOption('margin-bottom', '10mm');
        $pdf->setOption('enable-local-file-access', true);

        // Generate PDF and display in the browser
        return $pdf->stream('laporan-kerusakan-pc.pdf');
    }
}
