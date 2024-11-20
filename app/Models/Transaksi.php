<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;


    protected $table = 'tbl_transaksi_galon';
    protected $fillable = [
        'kode_transaksi',
        'jumlah',
        'total_harga',
        'alamat',
        'noHp'
    ];

    /**
     * Get the TransaksiDetail that owns the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function TransaksiDetail(): BelongsTo
    {
        return $this->belongsTo(TransaksiDetail::class, 'transaksi_id', 'id');
    }
}
