<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'title',
        'ubication',
        'maps_url',
        'date_time_start',
        'date_time_end',
        'image',
        'summary',
        'created_by'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'event_id', 'id');
    }
}
