<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kendaraan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function invoice()
    {
        return $this->hasMany(invoice::class);
    }
}
