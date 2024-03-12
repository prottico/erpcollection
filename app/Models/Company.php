<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'identity_type_id',
        'identification',
        'name',
        'comercial_name',
        'phone',
        'email',
        'token'
    ];

    public function person()
    {
        return $this->hasMany(Person::class);
    }
}
