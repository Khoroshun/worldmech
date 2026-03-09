<?php

namespace App\Models;

use App\Enums\ScaleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dataset extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'x_label',
        'y_label',
        'x_unit',
        'y_unit',
        'scale_type',
    ];

    protected $casts = [
        'scale_type' => ScaleType::class,
    ];

    public function dataPoints(): HasMany
    {
        return $this->hasMany(DataPoint::class)->orderBy('x_value', 'desc');
    }
}

