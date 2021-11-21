<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'item_desc',
        'quantity',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(ProviderInfo::class);
    }

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }
}
