<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
class Commercial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'media_url',
        'image',
        'ad_text', // ✅ AÑADIDO AQUÍ
        'publication_date',
        'expiration_date',
        'clicks',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}
