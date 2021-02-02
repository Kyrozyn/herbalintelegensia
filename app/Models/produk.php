<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    public function historistok()
    {
        return $this->hasMany(historistok::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(pemesanan::class);
    }
}
