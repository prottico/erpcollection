<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'credit_start_date',
        'debt_capital',
        'term',
        'current_interest_rate',
        'default_interest_rate',
        'interest_owed',
        'last_payment_day',
        'currency',
        'base_execution_document',
        'path_base_execution_document',
        'description',
        'comments',
        'token',
        'client_id',
        'type_payment_id'
    ];

    public function legalCase()
    {
        return $this->hasOne(LegalCase::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
