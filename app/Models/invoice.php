<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    public function pemesanans()
    {
        return $this->belongsToMany(pemesanan::class, 'invoice_pemesanan');
    }
    public function kendaraan()
    {
        return $this->belongsTo(kendaraan::class);
    }
}
