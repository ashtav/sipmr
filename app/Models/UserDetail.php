<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{

    protected $table = 'user_details';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'tgl_lahir',
        'tmp_lahir',
        'jk',
        'agama',
        'foto',
        'telp',
        'alamat',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
