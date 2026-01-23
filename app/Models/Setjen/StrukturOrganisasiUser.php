<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasiUser extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'struktur_organisasi_user';
    protected $primaryKey = 'id_struktur_organisasi';
    public $timestamps = false;
    protected $fillable = [
        'id_struktur_organisasi',
        'id_user',
    ];

}
