<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\UserDetail;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index(){
        $users = User::with('user_detail')->orderBy('name')->latest()->get();
        return view('admin.member', compact('users'));
    }

    public function store(Request $request){
        $user = Auth::user();

        if ($user->role != 'admin'){
            return response()->json([
                'message' => 'Akses tidak valid'
            ], 400);
        }

        $input = $request->except(['id','updated_at']);
        $input['name'] = ucwords($input['name']);
        $input['email'] = strtolower($input['email']);
        $input['password'] = app('hash')->make($request->password);

        try {
            $user = User::create($input);

            $input['user_id'] = $user->id;
            $input['tmp_lahir'] = ucwords($input['tmp_lahir']);
            $input['alamat'] = ucwords($input['alamat']);

            UserDetail::create($input);

            return response()->json([
                'message' => 'Anggota baru berhasil ditambahkan.',
                'data' => $input,
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    public function update(Request $request, $id){
        $user = User::find($id);
       
        $this->validate($request, [
            'email' => 'required|email|max:190|unique:users,email,' . $id,
        ]);

        $input = $request->except(['id','updated_at']);
        $input['name'] = ucwords($input['name']);
        

        try {
            $user->update($input);
            $userDetail = UserDetail::find($id);

            $input['user_id'] = $user->id;
            $input['tmp_lahir'] = ucwords($input['tmp_lahir']);
            $input['alamat'] = ucwords($input['alamat']);

            $userDetail->update($input);

            return response()->json([
                'message' => 'Anggota berhasil diperbarui.',
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function destroy($id){
        User::find($id)->delete();
    }
}
