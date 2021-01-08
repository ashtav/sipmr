<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Content;

class ContentController extends Controller
{
    // sejarah
    public function sejarah(){
        $content = Content::first();
        return view('admin.sejarah', compact('content'));
    }

    public function updateSejarah(Request $request, $id){

        try {
            Content::find($id)->update(['sejarah' => $request->content]);

            return response()->json([
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    // visi
    public function visi(){
        $content = Content::first();
        return view('admin.visi', compact('content'));
    }

    public function updateVisi(Request $request, $id){

        try {
            Content::find($id)->update(['visi' => $request->content]);

            return response()->json([
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    // struktur
    public function struktur(){
        $content = Content::first();
        return view('admin.struktur', compact('content'));
    }

    public function updateStruktur(Request $request, $id){

        try {
            Content::find($id)->update(['struktur' => $request->content]);

            return response()->json([
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function updateStrukturImg(Request $request){
        $konten = Content::find(1);
        $foto = $konten->img_struktur;

        $image_path = public_path()."public/images/".$foto;  // Value is not URL but directory file path
        if(file_exists($image_path)) {
            unlink($image_path);
        }

        $imageName = time().'.'.request()->filename->getClientOriginalExtension();
        request()->filename->move(public_path('images'), $imageName);

        $konten->update(['img_struktur' => $imageName]);
    }

}
