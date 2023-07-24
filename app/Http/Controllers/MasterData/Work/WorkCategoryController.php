<?php

namespace App\Http\Controllers\MasterData\Work;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Work\WorkCategory\StoreWorkCategoryRequest;
use App\Http\Requests\MasterData\Work\WorkCategory\UpdateWorkCategoryRequest;

// use model here
use App\Models\MasterData\Work\WorkCategory;

class WorkCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work_category = WorkCategory::orderBy('name', 'asc')->get();

        return view('pages.master-data.work.work_category.index', compact('work_category'));
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
    public function store(StoreWorkCategoryRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $work_category = WorkCategory::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.work_category.index');
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
        $work_category = WorkCategory::find($decrypt_id);

        return view('pages.master-data.work.work_category.edit', compact('work_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkCategoryRequest $request, WorkCategory $work_category)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $work_category->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.work_category.index');
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
        $work_category = WorkCategory::find($decrypt_id);

        // hapus location
        $work_category->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
