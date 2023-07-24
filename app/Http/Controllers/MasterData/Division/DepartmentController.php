<?php

namespace App\Http\Controllers\MasterData\Division;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Division\Department\StoreDepartmentRequest;
use App\Http\Requests\MasterData\Division\Department\UpdateDepartmentRequest;

// use model here
use App\Models\MasterData\Division\Department;
use App\Models\MasterData\Division\Division;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $division = Division::orderBy('name', 'asc')->get();
        $department = Department::orderBy('created_at', 'asc')->get();

        return view('pages.master-data.division.department.index', compact('division', 'department'));
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
    public function store(StoreDepartmentRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $department = Department::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.department.index');
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
        $department = Department::find($decrypt_id);
        $division = Division::orderBy('name', 'asc')->get();

        return view('pages.master-data.division.department.edit', compact('division', 'department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $department->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.department.index');
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
        $department = Department::find($decrypt_id);

        // hapus department
        $department->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
