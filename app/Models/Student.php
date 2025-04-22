<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class Student extends Model
class Student extends Authenticatable
{
    protected $fillable = [
        'first_name',
        'last_name',
        'id_number',
        'year_level',
        'organization',
        "section",
        "contact_number",
    ];

    public function getAuthIdentifierName()
    {
        return 'id_number'; // userid as username
    }

    public function getAuthPassword()
    {
        return $this->last_name; // password is the last name
    }
}
