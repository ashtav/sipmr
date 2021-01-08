<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    // protected $primaryKey = 'user_id';
    protected $table = 'kegiatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nama_kegiatan',
        'tgl_pelaksana',
        'waktu_pelaksana',
        'panitia',
        'deskripsi_kegiatan',
        'foto',
        'dilihat',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
