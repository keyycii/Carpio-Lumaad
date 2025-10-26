<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donut extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'flavor',
        'price',
        'stock',
        'image',  // Add this line
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
