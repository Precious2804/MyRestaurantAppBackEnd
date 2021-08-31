<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'menu_title',
        'amount',
        'chef',
        'description',
        'image'
    ];

    public $timestamps = true;
    public $incrementing = false;
    protected $keyType = 'string';
}
