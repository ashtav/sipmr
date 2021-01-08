<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Gallery;

class ProfileController extends Controller
{

    public function index(){
        $user = User::where('id', Auth::user()->id)->with('user_detail')->first();
        return view('admin.profile', compact('user'));
    }

    public function updateFoto(Request $request){
        $auth = Auth::user();

        $user = UserDetail::find($auth->id);
        $foto = $user->foto;

        $image_path = "public/profile/".$foto;  // Value is not URL but directory file path
        if(file_exists($image_path)) {
            unlink($image_path);
        }

        $imageName = time().'.'.request()->filename->getClientOriginalExtension();
        request()->filename->move(public_path('profile'), $imageName);

        $user->update(['foto' => $imageName]);

        
    }

}
