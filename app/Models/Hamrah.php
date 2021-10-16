<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hamrah extends Model
{
    use HasFactory;

    protected $table = 'hamrahan';

    protected $fillable = [
        'anjoman_id', 'payment_id', 'stdID', 'name', 'family', 'mobile', 'hamrahan', 'launchs', 'dinners', 'bill'
    ];

    public function payment()
    {
        return $this->belongsTo(HamrahPay::class, 'payment_id', 'id');
    }

    public function anjoman()
    {
        return $this->belongsTo(Anjoman::class, 'anjoman_id', 'id');
    }
}
