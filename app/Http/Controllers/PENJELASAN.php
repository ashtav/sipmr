<?php

namespace App\Http\Controllers; // menggunakan fungsi bawaan laravel

use Illuminate\Http\Request; // menggunakan request
use Auth; // user yg login
use App\Models\User; // memanggil model user
use App\Models\Gallery; // memanggil galeri galeri

// apa itu model?
// sebuah file yg menghubungkan controller dengan database, berisi configurasi data mana yg boleh diambil dsb

class GalleryController extends Controller
{
    public function __construct() // construct = semua yg ada didalamnya akan diexecute terlebih dulu
    {
        $this->user = Auth::user(); // gak ada jg gak masalah
    }

    // fungsi untuk menampilkan halaman
    public function index(){
        $gallery = Gallery::latest()->get(); // ambil data galeri, urutkan berdasarkan yg terakhir
        return view('admin.gallery', compact('gallery'));
    }

    // fungsi untuk menyimpan data
    public function store(Request $request){ // request = diammbil dari form input
        $user = Auth::user(); // user yang login

        if ($user->role != 'admin'){ // jika bukan admin, maka tidak bisa menambah data
            return response()->json([
                'message' => 'Akses tidak valid'
            ], 400); // 400 = kode gagal
        }

        // memberikan nama pada gambar, nama = waktu, untuk mecegah nama yg sama
        $imageName = time().'.'.request()->filename->getClientOriginalExtension();
        request()->filename->move(public_path('images'), $imageName); // memindahkan gambar yang diupload ke folder public

        $input = $request->except(['id']); // input semua kecuali id, karena id akan digenerate otomatis
        $input['filename'] = $imageName; // set nama gambar (waktu)

        try {
            Gallery::create($input); // simpan ke database
           
            return response()->json([ // jika berhasil
                'message' => 'Foto baru berhasil ditambahkan.',
                'status' => 201
            ], 201); // 201 = kode sukses

        } catch (\Exception $e) { // jika error
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    // fungsi untuk update
    public function update(Request $request, $id){ // paremter request dan id (update by id)

        try {
            Gallery::find($id)->update(['info' => $request->info]); // update data

            return response()->json([ // respon
                'message' => 'Foto berhasil diperbarui.',
                'status' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    // fungsi untuk menghapus
    public function destroy($id){ // parameter id
        $img = Gallery::find($id); // cari data by id

        $image_path = "public/images/".$img->filename; // set path (alamat gambar)
        if(file_exists($image_path)) { // jika gambar ada
            unlink($image_path); // hapus dari folder untuk menghemat storage
        }

        Gallery::find($id)->delete(); // hapus dari database
    }
}
