<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
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
}
