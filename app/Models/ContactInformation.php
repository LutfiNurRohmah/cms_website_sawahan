<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'thumbnail' => 'array',
    ];

    public function socialMedia()
    {
        return $this->hasMany(SocialMedia::class);
    }
}
