<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $fillable = [
        'title',
        'quantity',
        'type',
        'price',
        'date_time_start',
        'date_time_end',
        'event_id',
        'available'
    ];

    public function event(): BelongsTo{
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
