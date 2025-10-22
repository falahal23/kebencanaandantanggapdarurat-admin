<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiBencana extends Model
{
    use HasFactory;

    protected $table = 'donasi_bencana';
    protected $primaryKey = 'donasi_id';
    protected $fillable = [
        'kejadian_id',
        'donatur_nama',
        'jenis',
        'nilai',
    ];

    public function kejadian()
    {
        return $this->belongsTo(KejadianBencana::class, 'kejadian_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')->where('ref_table', 'donasi_bencana');
    }
}
