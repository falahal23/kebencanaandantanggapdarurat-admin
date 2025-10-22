<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogistikBencana extends Model
{
    use HasFactory;

    protected $table = 'logistik_bencana';
    protected $primaryKey = 'logistik_id';
    protected $fillable = [
        'kejadian_id',
        'nama_barang',
        'satuan',
        'stok',
        'sumber',
    ];

    public function kejadian()
    {
        return $this->belongsTo(KejadianBencana::class, 'kejadian_id');
    }

    public function distribusi()
    {
        return $this->hasMany(DistribusiLogistik::class, 'logistik_id');
    }
}
