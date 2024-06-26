<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'budget',
        'report_description',
        'club_id',
        'user_id',
        'photo',
        'report_images',
        'collaborators'
    ];

    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'event_club')->withPivot('status')->withTimestamps();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user')->withPivot('status')->withTimestamps();
    }
}
