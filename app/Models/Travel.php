<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Travel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'travels';

    protected $fillable = [
        'id',
        'is_public',
        'name',
        'description',
        'number_of_days',
    ];

    protected static function booted(): void
    {
        static::creating(function (Travel $travel): void {
            $travel->slug = Str::of($travel->name)->slug('-')->__toString();
        });
    }

    public function numberOfNights(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['number_of_days'] - 1,
        );
    }

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }
}
