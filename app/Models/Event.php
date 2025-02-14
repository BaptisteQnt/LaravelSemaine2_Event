<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'places', 'location', 'is_validated', 'created_by'];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function dates() {
        return $this->hasMany(EventDate::class);
    }

    public function keywords() {
        return $this->belongsToMany(Keyword::class, 'event_keywords')->select('keywords.*'); 
    }

    public function types() {
        return $this->belongsToMany(Type::class, 'event_type')->select('types.*');
    }

    public function artists() {
        return $this->belongsToMany(Artist::class);
    }
}
