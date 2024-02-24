<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'client_type_id', 'user_type_id', 'token'];

    public function legalCase()
    {
        return $this->hasMany(LegalCase::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function clientType()
    {
        return $this->belongsTo(ClientType::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }
}
