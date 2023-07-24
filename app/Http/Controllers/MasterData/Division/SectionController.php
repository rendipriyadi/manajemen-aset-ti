<?php

namespace App\Http\Controllers\MasterData\Division;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Division\Section\StoreSectionRequest;
use App\Http\Requests\MasterData\Division\Section\UpdateSectionRequest;

// use model here
use App\Models\MasterData\Division\Department;
use App\Models\MasterData\Division\Division;
use App\Models\MasterData\Division\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $division = Division::orderBy('name', 'asc')->get();
        $section = Section::orderBy('created_at', 'asc')->get();

        return view('pages.master-data.division.section.index', compact('division', 'section'));
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
    public function store(StoreSectionRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $section = Section::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.section.index');
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
        $section = Section::find($decrypt_id);
        $division = Division::orderBy('name', 'asc')->get();
        $department = Department::where('division_id', $section->division->id)->orderBy('name', 'asc')->get();

        return view('pages.master-data.division.section.edit', compact('division', 'department', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $section->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.section.index');
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
        $section = Section::find($decrypt_id);

        // hapus department
        $section->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
    // get data department
    public function get_department(Request $request)
    {
        $data['department'] = Department::where("division_id", $request->division_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }
    // get data section
    public function get_section(Request $request)
    {
        $data['section'] = Section::where("department_id", $request->department_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }
}
