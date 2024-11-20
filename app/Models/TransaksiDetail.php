<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_transaksi_detail_galon';
    protected $fillable = [
        'transaksi_id',
        'galon_id',
        'status_id',
        'subTotal'
    ];

    /**
     * Get all of the Transaksi for the TransaksiDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'transaksi_id', 'id');
    }
    /**
     * Get the galon that owns the IsiUlang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function galon(): BelongsTo
    {
        return $this->belongsTo(Galon::class, 'galon_id', 'id');
    }

    /**
     * Get all of the pengantaranStatus for the IsiUlang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengantaranStatus(): HasMany
    {
        return $this->hasMany(statusAntar::class, 'statusAntar_id', 'id');
    }
}
