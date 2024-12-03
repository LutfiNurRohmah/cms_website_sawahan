<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmAccount extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function umkm() {
        return $this->belongsTo(Umkm::class);
    }

    public function account() {
        return $this->belongsTo(Account::class);
    }
}
