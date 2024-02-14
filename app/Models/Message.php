<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function transmitter()
    {
        return $this->hasOne(User::class, 'transmitter_id');
    }

    public function receiver()
    {
        return $this->hasOne(User::class, 'receiver_id');
    }
}
