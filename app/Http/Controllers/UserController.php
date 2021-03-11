<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(10);
        $filterByEmail = $request->get('keyword');
        $status = $request->get('status');

        if ($status) {

            $users = User::where('email', 'LIKE', "%$filterByEmail%")
                ->where('status', $status)
                ->paginate(10);
        } else if ($filterByEmail) {

            $users = User::where('email', 'LIKE', "%$filterByEmail%")
                ->paginate(10);
        }

        return view('pages.users.data_users', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // menghandle data yang dikirim dari form create

        $new_user = new User;

        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        $new_user->roles = json_encode($request->get('roles'));
        $new_user->phone = $request->get('phone');
        $new_user->email = $request->get('email');
        $new_user->address = $request->get('address');
        $new_user->password = Hash::make($request->get('password'));

        // menghandle file upload

        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');

            $new_user->avatar = $file;
        }

        $new_user->save();

        return redirect()->route('data-users.index')->with('status', 'User seccessfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('pages.users.details-user', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::findOrFail($id);

        return view('pages.users.edit-user', [
            'item' => $item
        ]);
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
        $user = User::findOrFail($id);

        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->roles = json_encode($request->get('roles'));
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->status = $request->get('status');

        // menghandle jika ada request bertipe file dengan name='avatar'
        if ($request->file('avatar')) {

            // cek lagi, jika photo user yang ingin di edit ini memiliki file avatar , dan file tersebut ada diserver kita ? jika ada hapus file tersebut dong dan lakukan perubahan tentunya
            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {

                Storage::delete('public/' . $user->avatar);
            }

            // kalo tidak ada profile di server maka lakukan penyimpanan.
            $file = $request->file('avatar')->store('avatars', 'public');

            $user->avatar = $file;
        }

        $user->save();

        return redirect()->route('data-users.index')->with('status', 'User successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('data-users.index')->with('status-danger', 'User has ben deleted');
    }
}
