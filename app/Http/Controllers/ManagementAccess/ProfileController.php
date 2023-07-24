<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use library here
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// use model here
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('name', Auth::user()->name)->first();

        return view('pages.management-access.profile.index', compact('user'));
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
        $this->validate($request, [
            'password_lama' => 'required|string',
            'password_baru' => 'required|string',
            'confirm_password' => 'required|string'
        ]);

        $auth = Auth::user();

        // The passwords matches
        if (!Hash::check($request->get('password_lama'), $auth->password)) {
            alert()->warning('Gagal', 'Password lama tidak diketahui');
            return back();
        }

        // Current password and new password same
        if (strcmp($request->get('password_lama'), $request->password_baru) == 0) {
            alert()->warning('Gagal', 'Password baru tidak boleh sama dengan password lama');
            return back();
        }

        //New password and confirm password are not same
        if (!(strcmp($request->get('password_baru'), $request->get('confirm_password'))) == 0) {
            alert()->warning('Gagal', 'Password baru harus sama dengan password anda yang dikonfirmasi');
            return back();
        }

        // updatean user
        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->confirm_password);
        $user->save();
        alert()->success('Sukses', 'Profile berhasil diupdate');
        return back();
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
