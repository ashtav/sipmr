<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{

    public function index(){
        $activity = Activity::latest()->get();

        $user = Auth::user();

        foreach (Activity::get() as $key => $item) {
            $dilihat = $item->dilihat;
            DB::table('kegiatan')->update(['dilihat' => substr_replace($dilihat, ','.$user->id, strlen($dilihat), 0)]);
        }

        return view('admin.kegiatan', compact('activity'));
    }

    public function store(Request $request){
        $user = Auth::user();

        if ($user->role != 'admin'){
            return response()->json([
                'message' => 'Akses tidak valid'
            ], 400);
        }

        $input = $request->except(['id']);

        if(isset($request->filename)){

            $imageName = time().'.'.request()->filename->getClientOriginalExtension();
            request()->filename->move(public_path('images'), $imageName);

            $input['foto'] = $imageName;
        }else{
            $input['foto'] = '';
        }

        $input['user_id'] = $user->id();
        $input['nama_kegiatan'] = ucwords($request->nama_kegiatan);
        $input['panitia'] = ucwords($request->panitia);
        $input['dilihat'] = $user->id;

        try {
            Activity::create($input);
           
            return response()->json([
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    public function update(Request $request, $id){
        $activity = Activity::find($id);
        $user = Auth::user();
        
        if ($user->role != 'admin'){
            return response()->json([
                'message' => 'Akses tidak valid'
            ], 400);
        }

        $input = $request->except(['id']);

        if(isset($request->filename)){

            if($activity->foto != ''){
                $image_path = "public/images/".$activity->first()->foto; 
                if(file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $imageName = time().'.'.request()->filename->getClientOriginalExtension();
            request()->filename->move(public_path('images'), $imageName);

            $input['foto'] = $imageName;

            

        }else{
            $input['foto'] = $activity->foto;
        }
        
        $input['nama_kegiatan'] = ucwords($request->nama_kegiatan);
        $input['panitia'] = ucwords($request->panitia);
        $input['dilihat'] = $user->id;

        try {
            $activity->update($input);
           
            return response()->json([
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function destroy($id){
        $activity = Activity::find($id);

        $image_path = "public/images/".$activity->foto;  // Value is not URL but directory file path
        if(file_exists($image_path)) {
            unlink($image_path);
        }

        $activity->delete();
    }
}
