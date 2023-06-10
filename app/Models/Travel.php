<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'is_public',
        'name',
        'description',
        'number_of_days',
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
