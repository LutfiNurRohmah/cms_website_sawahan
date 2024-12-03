<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function umkmAccount()
    {
        return $this->hasMany(UmkmAccount::class, 'umkm_id');
    }

    public function umkmProduct()
    {
        return $this->hasMany(UmkmProduct::class, 'umkm_id');
    }

    public function umkmCategory() {
        return $this->belongsTo(UmkmCategory::class);
    }
}
