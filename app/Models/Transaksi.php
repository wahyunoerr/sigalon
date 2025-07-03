<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    use HasFactory;


    protected $table = 'tbl_transaksi_galon';
    protected $fillable = [
        'kode_transaksi',
        'jumlah',
        'total_harga',
    ];

    /**
     * Get the TransaksiDetail that belongs to the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function TransaksiDetail(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id', 'id');
    }

    /**
     * Boot method to delete related TransaksiDetail when a Transaksi is deleted.
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($transaksi) {
            $transaksi->TransaksiDetail()->delete();
        });
    }
}
