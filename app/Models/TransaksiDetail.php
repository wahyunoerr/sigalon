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
        'pelanggan_id',
        'jumlah',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengantaranStatus(): BelongsTo
    {
        return $this->belongsTo(statusAntar::class, 'status_id', 'id');
    }

    /**
     * Get the pelanggan that owns the TransaksiDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }
}
