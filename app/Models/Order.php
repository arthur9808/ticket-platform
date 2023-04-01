<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


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

    public function ticket(): BelongsTo{
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }
}
