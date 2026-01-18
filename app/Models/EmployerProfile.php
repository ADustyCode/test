<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'industry',
        'size',
        'year_founded',
        'location',
        'description',
        'website',
        'recruitment_email',
        'linkedin_link',
        'instagram_link',
        'culture',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
