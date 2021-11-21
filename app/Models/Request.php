<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_name'
    ];

    public function items()
    {
        return $this->hasMany(Items::class);
    }

    public function provider()
    {
        return $this->belongsTo(ProviderInfo::class)->with('speciality');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
