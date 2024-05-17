<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detiltransaksi extends Model
{
    protected $fillable=['transaksi_id','barang_id','qty','price'];
    use HasFactory;

    public function transaksi():BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function layanan():BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
