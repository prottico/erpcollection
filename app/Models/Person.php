<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'physical_client',
        'identification',
        'name',
        'lastname',
        'phone',
        'email',
        'associated_company',
        'identity_type',
        'comercial_name',
        'user_id',
        'identity_type_id',
        'company_id',
        'token',
        'responsible'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function identityType()
    {
        return $this->belongsTo(IdentityType::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class, 'lawyer_id');
    }

    public function company()
    {
        return $this->belongsTo(company::class);
    }
}
