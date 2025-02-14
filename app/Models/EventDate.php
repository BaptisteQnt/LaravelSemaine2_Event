<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDate extends Model
{
    protected $fillable = ['event_id', 'date'];

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
