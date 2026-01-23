<?php

namespace Modules\MagangPustekinfo\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversitasCustomModel extends Model
{
    use HasFactory;

    protected $connection = 'db_pustekinfo_internship';

    protected $table = 'universitas_custom';

    protected $fillable = [
        'name',
        'short_name',
        'group',
        'university_type',
        'address',
        'province',
        'province_code',
        'regency',
        'regency_code',
        'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
