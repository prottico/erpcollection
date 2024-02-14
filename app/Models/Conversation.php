<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    public function legalCase()
    {
        return $this->hasOne(LegalCase::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
