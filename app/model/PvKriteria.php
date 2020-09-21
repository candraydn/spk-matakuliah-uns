<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PvKriteria extends Model
{
    protected $table = 'pv_kriteria';
    protected $fillable = ['id_kriteria','nilai'];
}
