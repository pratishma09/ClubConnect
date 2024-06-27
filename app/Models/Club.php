<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'tenure_date',
        'president',
        'vice_president',
        'user_id',
        'logo',
        'initial_budget'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_club')->withPivot('amount_spent')->withTimestamps();
    }
}
