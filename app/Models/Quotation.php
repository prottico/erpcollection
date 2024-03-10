<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    /**
     * Set the description attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim($value);
    }

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
        'type_payment_id',
        'lawyer_id',
        'cost',
        'type_case_id',
        'code',
        'lawyer_commet',
        'credit_due_date',
        'currency_id',
        'amount_last_payment',
        'no_apply_last_payment_day'
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

    public function lawyer()
    {
        return $this->belongsTo(Person::class);
    }

    public function typeCase()
    {
        return $this->belongsTo(TypeCase::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
