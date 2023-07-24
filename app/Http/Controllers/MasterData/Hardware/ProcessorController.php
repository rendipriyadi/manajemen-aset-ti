<?php

namespace App\Http\Controllers\MasterData\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\MasterData\Hardware\Processor\StoreProcessorRequest;
use App\Http\Requests\MasterData\Hardware\Processor\UpdateProcessorRequest;

// use model here
use App\Models\MasterData\Hardware\Processor;

class ProcessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processor = Processor::orderBy('created_at', 'desc')->get();

        return view('pages.master-data.hardware.processor.index', compact('processor'));
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
    public function store(StoreProcessorRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $processor = Processor::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.processor.index');
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
        $processor = Processor::find($decrypt_id);

        return view('pages.master-data.hardware.processor.edit', compact('processor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcessorRequest $request, Processor $processor)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $processor->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.processor.index');
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
        $processor = Processor::find($decrypt_id);

        // hapus location
        $processor->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
