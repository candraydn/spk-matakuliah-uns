<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Promethee extends Model
{
    protected $table = 'promethee';
    protected $fillable = ['id_kriteria','id_alternatif','id_alternatif2','step','nilai'];
}
