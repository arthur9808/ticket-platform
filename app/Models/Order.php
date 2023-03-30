<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'name_buyer',
        'last_name_buyer',
        'email_buyer',
        'phone_buyer',
        'svg_qr',
        'code',
        'ticket_id'
    ];
}
