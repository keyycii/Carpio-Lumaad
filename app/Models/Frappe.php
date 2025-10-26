<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frappe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'size',
        'price',
        'stock',
        'image',  // Add this line
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
