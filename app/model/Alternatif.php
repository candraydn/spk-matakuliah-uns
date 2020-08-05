<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $fillable = ['nama_matakuliah', 'semester_matakuliah', 'dosen_matakuliah'];
}
