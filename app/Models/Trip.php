<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function origin_city()
    {
        return $this->belongsTo(City::class, 'origin', 'id_city');
    }
    public function destination_city()
    {
        return $this->belongsTo(City::class, 'destination', 'id_city');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}