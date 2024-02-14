<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalCase extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function typeCase()
    {
        return $this->belongsTo(TypeCase::class);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
