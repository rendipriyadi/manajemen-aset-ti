<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Data\WorkProgram\StoreWorkProgramRequest;
use App\Http\Requests\Data\WorkProgram\UpdateWorkProgramRequest;

// use mode here
use App\Models\Data\WorkProgram;

class WorkProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work_program = WorkProgram::orderBy('created_at', 'desc')->get();

        return view('pages.data.work_program.index', compact('work_program'));
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
    public function store(StoreWorkProgramRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $work_program = WorkProgram::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.work_program.index');
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
        $work_program = WorkProgram::find($decrypt_id);

        return view('pages.data.work_program.show', compact('work_program'));
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
        $work_program = WorkProgram::find($decrypt_id);

        return view('pages.data.work_program.edit', compact('work_program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkProgramRequest $request, WorkProgram $work_program)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $work_program->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.work_program.index');
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
        $work_program = WorkProgram::find($decrypt_id);

        // hapus work_program
        $work_program->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
