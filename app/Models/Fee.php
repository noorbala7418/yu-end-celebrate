<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $table = 'fees';

    const TYPE_GIFT = 'gift';
    const TYPE_FOOD = 'food';
    const TYPE_CODE = 'code';

    const TYPES = [self::TYPE_FOOD, self::TYPE_GIFT, self::TYPE_CODE];

    protected $fillable = [
        'product', 'type', 'unit', 'amount'
    ];
}
