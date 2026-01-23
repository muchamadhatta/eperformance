<?php

namespace App\Models\Siap;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ortala\Jabatan;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Pegawai extends Authenticatable
{
    protected $connection = 'mysql_siap';

   protected $table = 'pegawai';

   protected $with = ['satker:id,nama_satker','jabatan:id,nama_jabatan,eselon'];

   public function satker()
    {
        return $this->belongsTo(Satker::class, 'id_satker');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    protected $appends = ['masa_kerja'];

    // Global scope untuk mengambil atribut yang dihitung
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('masa_kerja', function ($builder) {

            $builder->select('pegawai.id','nama', 'nip','pegawai.id_satker','pegawai.id_jabatan', 'golongan',DB::raw('CONCAT(
                FLOOR(DATEDIFF(CURDATE(), CONCAT(SUBSTRING(nip, 9, 4), "-", SUBSTRING(nip, 13, 2), "-01")) / 365), " tahun ",
                FLOOR((DATEDIFF(CURDATE(), CONCAT(SUBSTRING(nip, 9, 4), "-", SUBSTRING(nip, 13, 2), "-01")) % 365) / 30), " bulan"
            ) AS masa_kerja'));
            $builder->where('status_pegawai', 'PNS');
        });
    }

    // Aksesor untuk atribut "masa_kerja"
    public function getMasaKerjaAttribute()
    {
        return $this->attributes['masa_kerja'];
    }
}
