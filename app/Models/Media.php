<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'media_id';
    public $timestamps = true;

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_url',
        'caption',
        'mime_type',
        'sort_order'
    ];

    // Relasi polymorphic manual
    public function related()
    {
        return $this->morphTo(__FUNCTION__, 'ref_table', 'ref_id');
    }
}
