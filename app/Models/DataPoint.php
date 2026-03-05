<?php

namespace App\Models;

use App\Enums\ScaleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\ValidationException;

class DataPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'dataset_id',
        'x_value',
        'y_value',
    ];

    public function dataset(): BelongsTo
    {
        return $this->belongsTo(Dataset::class);
    }

    protected static function booted(): void
    {
        static::saving(function (DataPoint $dataPoint) {
            $dataset = $dataPoint->dataset ?? Dataset::find($dataPoint->dataset_id);

            if (! $dataset) {
                return;
            }

            if ($dataset->scale_type === ScaleType::LOG) {
                if ($dataPoint->x_value <= 0 || $dataPoint->y_value <= 0) {
                    throw ValidationException::withMessages([
                        'x_value' => 'x_value must be > 0 in log scale datasets.',
                        'y_value' => 'y_value must be > 0 in log scale datasets.',
                    ]);
                }
            }
        });
    }
}

