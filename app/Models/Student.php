<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'anjoman_id', 'payment_id', 'stdID', 'name', 'family', 'mobile', 'hamrahan', 'tandis', 'dinners'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function anjoman()
    {
        return $this->belongsTo(Anjoman::class, 'anjoman_id', 'id');
    }
}
