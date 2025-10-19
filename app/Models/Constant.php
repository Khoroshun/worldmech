<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Constant extends Model
{
    protected $table = 'constants';

    protected $fillable = [
        'material_id','b','d','n','k','m','l','temperature','a','source',
    ];

    protected $casts = [
        'n' => 'float',
        'k' => 'float',
        'm' => 'float',
        'l' => 'float',
        'temperature' => 'float',
        'a' => 'float',
    ];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
