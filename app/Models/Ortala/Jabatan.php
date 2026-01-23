<?php

namespace App\Models\Ortala;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $connection = 'mysql_ortala';//ini gaguna

    // public function __construct(array $attributes= [])
    // {
    //     $this->table = 'db_ortala.'.$this->table;
    //     parent::__construct($attributes);
    // }

    protected $table= 'db_ortala.jabatan';
    protected $guarded = [];
}
