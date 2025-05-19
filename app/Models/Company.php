<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'company_name',
        'nif',
        'contact_email',
        'phone_number',
    ];



    public function commercials(): HasMany
    {
        return $this->hasMany(Commercial::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

