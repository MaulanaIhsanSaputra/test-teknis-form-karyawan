<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experiences';

    protected $fillable = [
        'perusahaan', 
        'jabatan',
        'tahun',
    ];
}
