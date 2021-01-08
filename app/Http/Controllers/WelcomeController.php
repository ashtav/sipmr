<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Materi;
use App\Models\Pengumuman;
use App\Models\Activity;

class WelcomeController extends Controller
{
    public function index(){
        $user = User::count();
        $materi = Materi::count();
        $pengumuman = Pengumuman::count();
        $kegiatan = Activity::count();
        
        $ts = substr_replace('1', ',5', 888, 0);

        return view('admin.index', compact(['user','materi','pengumuman','kegiatan','ts']));
    }
}
