<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'sekolah', 
        'jurusan',
        'tahun_masuk',
        'tahun_lulus'
    ];
}
