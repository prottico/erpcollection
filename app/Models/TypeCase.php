<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCase extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function legalCase()
    {
        return $this->hasOne(LegalCase::class);
    }

    public function quotation()
    {
        return $this->hasOne(Quotation::class);
    }
}
