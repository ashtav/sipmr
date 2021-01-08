<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Materi;

class MateriController extends Controller
{
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index(){
        $materi = Materi::latest()->get();
        return view('admin.materi', compact('materi'));
    }

    public function store(Request $request){
        $user = Auth::user();

        if ($user->role != 'admin'){
            return response()->json([
                'message' => 'Akses tidak valid'
            ], 400);
        }

        $imageName = time().'.'.request()->filename->getClientOriginalExtension();
        request()->filename->move(public_path('files'), $imageName);

        $input = $request->except(['id']);
        $input['filename'] = $imageName;
        $input['user_id'] = $user->id();

        try {
            Materi::create($input);
           
            return response()->json([
                'message' => 'Materi baru berhasil ditambahkan.',
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    public function update(Request $request, $id){

        try {
            Materi::find($id)->update(['info' => $request->info]);

            return response()->json([
                'message' => 'Materi berhasil diperbarui.',
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function destroy($id){
        $file = Materi::find($id);

        $path = "public/files/".$file->filename;  // Value is not URL but directory file path
        if(file_exists($path)) {
            unlink($path);
        }

        Materi::find($id)->delete();
    }
}
