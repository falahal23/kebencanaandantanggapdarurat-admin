<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    public $timestamps = true;

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email'
    ];

    // Relasi ke distribusi logistik
    public function distribusiLogistik()
    {
        return $this->hasOne(DistribusiLogistik::class, 'penerima', 'warga_id');
    }
}
