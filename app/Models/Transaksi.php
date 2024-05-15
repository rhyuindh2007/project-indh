<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable=['invoice','pelanggan_id','user_id','total'];

    public function transaksi_detail():HasMany
    {
        return $this->hasMany(Transaksi_detail::class);
    }

    public function pelanggan():BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
