<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public function produk()
    {
        return $this->belongsTo(produk::class);
    }
    public function pelanggan()
    {
        return $this->belongsTo(pelanggan::class);
    }
    public function invoice()
    {
        return $this->belongsToMany(invoice::class, 'invoice_pemesanan');
    }
}
