<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'title',
        'description',
        'image'
    ];

    public $incrementing = false;
    protected $keyType = 'string';
}
