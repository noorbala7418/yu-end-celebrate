<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HamrahPay extends Model
{
    use HasFactory;

    protected $table = 'hamrahan_payments';
    protected $fillable = [
        'anjoman_id', 'is_paid', 'person_confirmed', 'order_id', 'bill', 'transaction_id', 'reference_id', 'status_code',
        'name', 'family', 'stdID', 'mobile',  'hamrahan', 'launchs', 'dinners', 'link'
    ];

    public function anjoman()
    {
        return $this->belongsTo(Anjoman::class, 'anjoman_id', 'id');
    }
}
