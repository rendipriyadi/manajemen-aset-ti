<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Data\DailyActivity\StoreDailyActivityRequest;
use App\Http\Requests\Data\DailyActivity\UpdateDailyActivityRequest;

// use library here
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

// use model here
use App\Models\Data\DailyActivity;
use App\Models\Data\DailyActivityFile;
use App\Models\MasterData\Location\LocationRoom;
use App\Models\MasterData\Work\WorkCategory;
use App\Models\MasterData\Work\WorkType;
use App\Models\User;

class DailyActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $executor =  Auth::user()->name;
        $user_id =  Auth::user()->id;
        $user = User::where('name', '!=', 'Administrator')->orderBy('name', 'asc')->get();
        $work_category = WorkCategory::orderBy('name', 'asc')->get();
        $work_type = WorkType::where('section', Auth::user()->detail_user->job_position)->get();
        $location_room = LocationRoom::orderBy('name', 'asc')->get();
        $daily_activity = DailyActivity::orderBy('created_at', 'desc')->get();

        return view('pages.data.daily_activity.index', compact('executor', 'user_id', 'user', 'work_category', 'work_type', 'location_room', 'daily_activity'));
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
    public function store(StoreDailyActivityRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $daily_activity = DailyActivity::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.daily_activity.index');
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
        $daily_activity = DailyActivity::find($decrypt_id);

        return view('pages.data.daily_activity.show', compact('daily_activity'));
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
        $daily_activity = DailyActivity::find($decrypt_id);

        $user = User::orderBy('name', 'asc')->get();
        $work_category = WorkCategory::orderBy('name', 'asc')->get();
        $work_type = WorkType::where('section', Auth::user()->detail_user->job_position)->get();
        $location_room = LocationRoom::orderBy('name', 'asc')->get();

        return view('pages.data.daily_activity.edit', compact('user', 'work_category', 'work_type', 'location_room', 'daily_activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDailyActivityRequest $request, DailyActivity $daily_activity)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $daily_activity->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.daily_activity.index');
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
        $daily_activity = DailyActivity::find($decrypt_id);

        // hapus daily activity
        $daily_activity->forceDelete();

        // get file daily activity
        $daily_activity_file = DailyActivityFile::where('daily_activity_id', $decrypt_id)->get();
        // hapus file
        foreach ($daily_activity_file as $file) {
            if ($file->file != null || $file->file != '') {
                Storage::delete($file->file);
            }
        }

        // delete data file daily activity
        $daily_activity_file = DailyActivityFile::where('daily_activity_id', $decrypt_id)->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // get form upload daily activity
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = DailyActivity::find($id);
            $data = [
                'id' => $row['id'],
            ];

            $msg = [
                'data' => view('pages.data.daily_activity.upload_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // upload file
    public function upload(Request $request)
    {
        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file = $image->storeAs('assets/file-daily-activity', $image->getClientOriginalName());
                DailyActivityFile::create([
                    'daily_activity_id' => $request->id,
                    'file'        => $file
                ]);
            }
        }

        alert()->success('Sukses', 'File Berhasil diupload');
        return redirect()->route('backsite.daily_activity.index');
    }

    // get show_file software
    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $daily_activity_file = DailyActivityFile::where('daily_activity_id', $id)->get();
            $data = [
                'datafile' => $daily_activity_file
            ];

            $msg = [
                'data' => view('pages.data.daily_activity.detail_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // hapus file dailiy activity
    public function hapus_file($id)
    {
        $daily_activity_file = DailyActivityFile::find($id);

        // cari old photo
        $path_file = $daily_activity_file['file'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }

        $daily_activity_file->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
