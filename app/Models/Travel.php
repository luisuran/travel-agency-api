<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected static function booted(): void
    {
        static::saving(function (Travel $travel): void {
            $travel->slug = Str::of($travel->name)->slug('-');
            $travel->number_of_nights = $travel->number_of_days - 1;
        });
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
