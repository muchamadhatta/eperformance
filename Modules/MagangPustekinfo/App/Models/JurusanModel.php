<?php

namespace Modules\MagangPustekinfo\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanModel extends Model
{
    use HasFactory;

    protected $connection = 'db_pustekinfo_internship';

    protected $table = 'jurusan';

    protected $fillable = [
        'name',
        'level',
        'faculty',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
