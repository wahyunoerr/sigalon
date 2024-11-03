<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IsiUlang extends Model
{
    use HasFactory;

    protected $table = 'tbl_isi_ulang';

    protected $fillable = [
        'galon_id',
        'statusAntar_id',
        'jumlah',
        'alamat',
        'noHp'
    ];

    /**
     * Get the galon that owns the IsiUlang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function galon(): BelongsTo
    {
        return $this->belongsTo(Galon::class, 'galon_id', 'id');
    }
}