<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;
    
    protected $fillable=['barang','stock','harga','description'];
    
    public function detiltransaksi():HasMany
    {
        return $this->hasMany(detiltransaksi::class);
    }
}