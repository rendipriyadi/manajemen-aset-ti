<?php

namespace App\Http\Controllers\MasterData\Work;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Work\WorkType\StoreWorkTypeRequest;
use App\Http\Requests\MasterData\Work\WorkType\UpdateWorkTypeRequest;

// use model here
use App\Models\MasterData\Work\WorkType;

class WorkTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work_type = WorkType::orderBy('section', 'asc')->get();

        return view('pages.master-data.work.work_type.index', compact('work_type'));
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
    public function store(StoreWorkTypeRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $work_type = WorkType::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.work_type.index');
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
        $work_type = WorkType::find($decrypt_id);

        return view('pages.master-data.work.work_type.edit', compact('work_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkTypeRequest $request, WorkType $work_type)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $work_type->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.work_type.index');
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
        $work_type = WorkType::find($decrypt_id);

        // hapus location
        $work_type->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
