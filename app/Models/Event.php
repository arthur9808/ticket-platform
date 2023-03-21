<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'title',
        'ubication',
        'date_time_start',
        'date_time_end',
        'image',
        'summary',
        'created_by',
    ];
}
