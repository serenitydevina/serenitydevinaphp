<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = "mahasiswas";
    protected $fillable = ['npm','nama_mahasiswa','tempat_lahir','tanggal_lahir','alamat',/*'prodi_id'*/];

    public function prodi(){
        return $this->belongsTo('App\Models\Prodi');
    }
}
