<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anjoman extends Model
{
    use HasFactory;

    protected $table = 'anjomans';
    protected $fillable = [
        'name', 'person_price', 'hamrahan_price', 'total_people', 'used_people'
    ];
}
