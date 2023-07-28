<?php

namespace App\Http\Controllers\Data\Hardware;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

// request
use Illuminate\Support\Facades\DB;
use App\Models\MasterData\Employee;

// use model here
use App\Http\Controllers\Controller;
use App\Models\Data\Hardware\DevicePc;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Data\Hardware\DeviceMore;
use App\Models\Data\Hardware\DeviceUser;
use App\Models\Data\Hardware\DeviceMonitor;
use App\Models\MasterData\Software\Software;

// use library here
use App\Models\Data\Hardware\DeviceAdditional;
use App\Http\Requests\Data\Hardware\StoreExportPdfRequest;
use App\Http\Requests\Data\Hardware\DeviceUser\StoreDeviceUserRequest;
use App\Http\Requests\Data\Hardware\DeviceUser\UpdateDeviceUserRequest;
use App\Models\MasterData\Location\Location;

class DeviceUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $device_user = DeviceUser::all();

        return view('pages.data.hardware.device-user.index', compact('device_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $device_pc = DevicePc::where('status', 1)->orderby('no_asset', 'asc')->get();
        $device_monitor = DeviceMonitor::where('status', 1)->orderby('no_asset', 'asc')->get();
        $device_more = DeviceMore::where('status', 1)->orderby('no_asset', 'asc')->get();
        $device_additional = DeviceAdditional::where('status', 1)->orderby('type_device_id', 'asc')->get();
        $software = Software::orderby('software_category', 'asc')->get();
        $employee = Employee::orderby('name', 'asc')->get();
        $location = Location::orderby('name', 'asc')->get();

        return view('pages.data.hardware.device-user.create', compact('device_pc', 'device_monitor', 'device_more', 'device_additional', 'software', 'employee', 'location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeviceUserRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // update device_pc
        DevicePc::where('id', $data['device_pc_id'])->update(['status' => '2']);

        // update device_monitor
        DeviceMonitor::whereIn('id', $data['device_monitor_id'])->update(['status' => '2']);

        // update device_additional
        DeviceAdditional::whereIn('id', $data['device_additional_id'])->update(['status' => '2']);

        // update device_more
        DeviceMore::whereIn('id', $data['device_more_id'])->update(['status' => '2']);

        // process implode
        $data['device_monitor_id'] = implode(',', $request['device_monitor_id']);
        $data['device_additional_id'] = implode(',', $request['device_additional_id']);
        $data['device_more_id'] = implode(',', $request['device_more_id']);
        $data['software_id'] = implode(',', $request['software_id']);

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-user', $request->file('file')->getClientOriginalName());
        }

        // store to database
        $device_user = DeviceUser::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.device_user.index');
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
        $device_user = DeviceUser::find($decrypt_id);

        return view('pages.data.hardware.device-user.show', compact('device_user'));
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
        $device_user = DeviceUser::find($decrypt_id);

        $device_pc = DevicePc::orderby('no_asset', 'asc')->get();
        $device_monitor = DeviceMonitor::orderby('no_asset', 'asc')->get();
        $device_more = DeviceMore::orderby('no_asset', 'asc')->get();
        $device_additional = DeviceAdditional::orderby('type_device_id', 'asc')->get();
        $software = Software::orderby('software_category', 'asc')->get();
        $employee = Employee::orderby('name', 'asc')->get();
        $location = Location::orderby('name', 'asc')->get();

        return view('pages.data.hardware.device-user.edit', compact('device_user', 'device_pc', 'device_monitor', 'device_more', 'device_additional', 'software', 'employee', 'location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeviceUserRequest $request, DeviceUser $device_user)
    {
        // get all request from frontsite
        $data = $request->all();

        // set semua status device ke status == 1
        // update device_pc
        $data_pc = $device_user['device_pc_id'];
        DevicePc::where('id', $data_pc)->update(['status' => '1']);

        // update device_monitor
        $data_monitor = explode(',', $device_user['device_monitor_id']);
        DeviceMonitor::whereIn('id', $data_monitor)->update(['status' => '1']);

        // update device_additional
        $data_additional = explode(',', $device_user['device_additional_id']);
        DeviceAdditional::whereIn('id', $data_additional)->update(['status' => '1']);

        // update device_more
        $data_more = explode(',', $device_user['device_more_id']);
        DeviceMore::whereIn('id', $data_more)->update(['status' => '1']);

        // update semua status device == 2
        // update device_pc
        DevicePc::where('id', $data['device_pc_id'])->update(['status' => '2']);

        // update device_monitor
        DeviceMonitor::whereIn('id', $data['device_monitor_id'])->update(['status' => '2']);

        // update device_additional
        DeviceAdditional::whereIn('id', $data['device_additional_id'])->update(['status' => '2']);

        // update device_more
        DeviceMore::whereIn('id', $data['device_more_id'])->update(['status' => '2']);

        // cek status aktif/tidak aktif
        if ($data['status'] == 2) {
            // update device_pc
            DevicePc::where('id', $data['device_pc_id'])->update(['status' => '1']);

            // update device_monitor
            DeviceMonitor::whereIn('id', $data['device_monitor_id'])->update(['status' => '1']);

            // update device_additional
            DeviceAdditional::whereIn('id', $data['device_additional_id'])->update(['status' => '1']);

            // update device_more
            DeviceMore::whereIn('id', $data['device_more_id'])->update(['status' => '1']);
        }

        // process implode
        $data['device_monitor_id'] = implode(',', $request['device_monitor_id']);
        $data['device_additional_id'] = implode(',', $request['device_additional_id']);
        $data['device_more_id'] = implode(',', $request['device_more_id']);
        $data['software_id'] = implode(',', $request['software_id']);

        // cari old photo
        $path_file = $device_user['file'];

        // upload process here
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->storeAs('assets/file-device-user', $request->file('file')->getClientOriginalName());
            // hapus file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $data['file'] = $path_file;
        }

        // update to database
        $device_user->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.device_user.index');
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
        $device_user = DeviceUser::find($decrypt_id);

        // update device_monitor
        $data_pc = $device_user['device_pc_id'];
        DevicePc::where('id', $data_pc)->update(['status' => '1']);

        // update device_monitor
        $data_monitor = explode(',', $device_user['device_monitor_id']);
        DeviceMonitor::whereIn('id', $data_monitor)->update(['status' => '1']);

        // update device_additional
        $data_additional = explode(',', $device_user['device_additional_id']);
        DeviceAdditional::whereIn('id', $data_additional)->update(['status' => '1']);

        // update device_more
        $data_more = explode(',', $device_user['device_more_id']);
        DeviceMore::whereIn('id', $data_more)->update(['status' => '1']);

        // cari old photo
        $path_file = $device_user['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        // hapus device user
        $device_user->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // get data pc
    public function get_data_pc(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $data_pc = DevicePc::find($id);

            // get data ram
            $ram_temp = [];
            foreach (explode(',', $data_pc->ram_id) as $data_ram) {
                $spek_ram = DB::table('hardware_ram')
                    ->where('id', $data_ram)
                    ->first();

                $ram_temp[] = $spek_ram->name;
            }
            // get data hardisk
            $hardisk_temp = [];
            foreach (explode(',', $data_pc->hardisk_id) as $data_hardisk) {
                $spek_hardisk = DB::table('hardware_hardisk')
                    ->where('id', $data_hardisk)
                    ->first();

                $hardisk_temp[] = $spek_hardisk->name;
            }

            if ($data_pc == null || $data_pc == '') {
                $msg = [
                    'error' => 'Data tidak ditemukan'
                ];
            } else {
                $data = [
                    'processor' => $data_pc->processor['name'],
                    'motherboard' => $data_pc->motherboard['name'],
                    'ram' =>  implode(', ', $ram_temp),
                    'hardisk' =>   implode(', ', $hardisk_temp),                    // 'hardisk' => $data_hardisk,
                ];
                $msg = [
                    'sukses' => $data,
                ];
            }

            return response()->json($msg);
        }
    }

    public function show_barcode($id)
    {
        $device_user = DeviceUser::find($id);

        return view('pages.data.hardware.device-user.show_barcode', compact('device_user'));
    }

    // export pdf
    public function printPdf(StoreExportPdfRequest $request)
    {
        $dari_tgl = $request->dari;
        $sampai_tgl = $request->sampai;

        // cari troubleshoot pc
        // cari troubleshoot pc
        $device_user = DeviceUser::where('tgl_deploy', '>=', $dari_tgl)
            ->where('tgl_deploy', '<=', $sampai_tgl)
            ->orderby('tgl_deploy', 'asc')
            ->get();

        $pdf = SnappyPdf::loadView('pages.laporan.laporan-aset-user', [
            'device_user' => $device_user,
            'dari_tgl' => $dari_tgl,
            'sampai_tgl' => $sampai_tgl
        ]);
        $pdf->setOption('page-size', 'A4');
        $pdf->setOption('margin-bottom', '10mm');
        $pdf->setOption('enable-local-file-access', true);

        // Generate PDF and display in the browser
        return $pdf->stream('laporan-aset-user.pdf');
    }
}
