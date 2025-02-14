<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = ['name'];

    public function events() {
        return $this->belongsToMany(Event::class, 'event_keywords');
    }
}
