<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'owner_name',
        'work_email',
        'phone1',
        'phone2',
        'phone3',
        'address1',
        'address2',
        'user_id',
        'speciality_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }
}
