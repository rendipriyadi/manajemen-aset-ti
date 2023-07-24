<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Employee\StoreEmployeeRequest;
use App\Http\Requests\MasterData\Employee\UpdateEmployeeRequest;

// use model here
use App\Models\MasterData\Division\Department;
use App\Models\MasterData\Division\Division;
use App\Models\MasterData\Division\Section;
use App\Models\MasterData\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $division = Division::orderBy('name', 'asc')->get();
        $department = Department::orderBy('name', 'asc')->get();
        $section = Section::orderBy('name', 'asc')->get();
        $employee = Employee::orderBy('name', 'asc')->get();

        return view('pages.master-data.employee.index', compact('division', 'department', 'section', 'employee'));
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
    public function store(StoreEmployeeRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $employee = Employee::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.employee.index');
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
        $employee = Employee::find($decrypt_id);

        return view('pages.master-data.employee.show', compact('employee'));
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
        $employee = Employee::find($decrypt_id);
        $division = Division::orderBy('name', 'asc')->get();
        $department = Department::where('division_id', $employee->division->id)->orderBy('name', 'asc')->get();
        $section = Section::where('department_id', $employee->department->id)->orderBy('name', 'asc')->get();

        return view('pages.master-data.employee.edit', compact('division', 'department', 'section', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $employee->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.employee.index');
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
        $employee = Employee::find($decrypt_id);

        // hapus employee
        $employee->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
