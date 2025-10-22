<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KejadianBencana extends Model
{
    use HasFactory;

    protected $table      = 'kejadian_bencana';
    protected $primaryKey = 'kejadian_id';
    protected $fillable   = [
        'jenis_bencana',
        'tanggal',
        'lokasi_text',
        'rt',
        'rw',
        'dampak',
        'status_kejadian',
        'keterangan',
        'media', // optional jika ada 1 media utama
    ];

    // Relasi ke Posko
    public function posko()
    {
        return $this->hasMany(PoskoBencana::class, 'kejadian_id');
    }

    // Relasi ke Donasi
    public function donasi()
    {
        return $this->hasMany(DonasiBencana::class, 'kejadian_id');
    }

    // Relasi ke Logistik
    public function logistik()
    {
        return $this->hasMany(LogistikBencana::class, 'kejadian_id');
    }

    // Relasi ke Media (banyak file)
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')
            ->where('ref_table', 'kejadian_bencana');
    }
}
