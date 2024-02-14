<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCase extends Model
{
    use HasFactory;

    public function legalCase()
    {
        return $this->hasOne(LegalCase::class);
    }
}
