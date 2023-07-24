<?php

namespace App\Http\Controllers;

use App\Models\Data\Hardware\DeviceAdditional;
use App\Models\Data\Hardware\DeviceMonitor;
use App\Models\Data\Hardware\DeviceMore;
use App\Models\Data\Hardware\DevicePc;
use App\Models\Data\Hardware\DeviceUser;
use App\Models\MasterData\Employee;
use Illuminate\Http\Request;

// use library here
use Illuminate\Support\Facades\DB;

// use model here
use App\Models\MasterData\Network\Cctv;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pc = DevicePc::count();
        $monitor = DeviceMonitor::count();
        $aksesoris = DeviceAdditional::count();
        $perangkat_tambahan = DeviceMore::count();
        $employeeIds = DeviceUser::pluck('employee_id');

        $divisionNames = Employee::whereIn('employee.id', $employeeIds)
            ->join('division', 'employee.division_id', '=', 'division.id')
            ->pluck('division.name', 'employee.id');

        $divisionCounts = collect($divisionNames)->countBy();

        return view('pages.dashboard.index', compact('pc', 'monitor', 'aksesoris', 'perangkat_tambahan', 'divisionNames', 'divisionCounts'));
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
