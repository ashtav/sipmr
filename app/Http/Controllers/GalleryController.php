<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index(){
        $gallery = Gallery::latest()->get();
        return view('admin.gallery', compact('gallery'));
    }

    public function store(Request $request){
        $user = Auth::user();

        if ($user->role != 'admin'){
            return response()->json([
                'message' => 'Akses tidak valid'
            ], 400);
        }

        $imageName = time().'.'.request()->filename->getClientOriginalExtension();
        request()->filename->move(public_path('images'), $imageName);

        $input = $request->except(['id']);
        $input['filename'] = $imageName;

        try {
            Gallery::create($input);
           
            return response()->json([
                'message' => 'Foto baru berhasil ditambahkan.',
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    public function update(Request $request, $id){

        try {
            Gallery::find($id)->update(['info' => $request->info]);

            return response()->json([
                'message' => 'Foto berhasil diperbarui.',
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function destroy($id){
        $img = Gallery::find($id);

        $image_path = "public/images/".$img->filename;  // Value is not URL but directory file path
        if(file_exists($image_path)) {
            unlink($image_path);
        }

        // Gallery::find($id)->delete();
    }
}
