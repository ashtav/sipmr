<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{

    public function index(){
        $pengumuman = Pengumuman::latest()->get();

        $user = Auth::user();

        foreach (Pengumuman::get() as $key => $item) {
            $dilihat = $item->dilihat;
            DB::table('pengumuman')->update(['dilihat' => substr_replace($dilihat, ','.$user->id, strlen($dilihat), 0)]);
        }

        return view('admin.pengumuman', compact('pengumuman'));
    }

    public function store(Request $request){
        $user = Auth::user();

        if ($user->role != 'admin'){
            return response()->json([
                'message' => 'Akses tidak valid'
            ], 400);
        }

        $input = $request->except(['id']);
        $input['judul'] = ucwords($request->judul);
        $input['dilihat'] = $user->id;
        $input['user_id'] = $user->id;

        try {
            Pengumuman::create($input);
           
            return response()->json([
                'message' => 'Pengumuman baru berhasil ditambahkan.',
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    public function update(Request $request, $id){

        try {
            Pengumuman::find($id)->update(['judul' => ucwords($request->judul), 'pengumuman' => $request->pengumuman]);

            return response()->json([
                'message' => 'Pengumuman berhasil diperbarui.',
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function destroy($id){
        Pengumuman::find($id)->delete();
    }
}
