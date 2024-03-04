<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function quotation()
    {
        return $this->hasOne(Quotation::class, 'currency_id');
    }
}
