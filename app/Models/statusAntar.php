<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class statusAntar extends Model
{
    use HasFactory;

    protected $table = 'tbl_status_antar';

    protected $fillable = [
        'name',
        'harga'
    ];

    /**
     * Get the isiUlang that owns the statusAntar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function TransakasiDetail(): BelongsTo
    {
        return $this->belongsTo(TransaksiDetail::class, 'statusAntar_id', 'id');
    }
}
