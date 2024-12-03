<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function contactInformation()
    {
        return $this->belongsTo(ContactInformation::class);
    }
}
