<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{

    public function index(){
        $pengumuman = Pengumuman::latest()->get();
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
