<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PerbandinganKriteria extends Model
{
    protected $table = "perbandingan_kriteria";
    protected $fillable = ['kriteria1','kriteria2','nilai'];
}
