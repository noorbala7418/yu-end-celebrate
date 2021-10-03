<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'order_id', 'bill', 'link', 'transaction_id', 'reference_id', 'status_code',
        'name', 'family', 'stdID', 'mobile', 'email'
    ];
}
