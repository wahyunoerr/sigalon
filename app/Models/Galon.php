<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galon extends Model
{
    use HasFactory;

    protected $table = 'tbl_galon';

    protected $fillable = [
        'name',
        'harga'
    ];

    /**
     * Get the isiUlanng that owns the Galon
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function isiUlang(): BelongsTo
    {
        return $this->belongsTo(IsiUlang::class, 'galon_id', 'id');
    }
}
