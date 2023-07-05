<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'plant_id',
        'name',
        'slug',
        'description',
        'address',
        'city',
        'zip',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}
