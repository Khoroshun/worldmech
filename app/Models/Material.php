<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $fillable = ['title'];

    public $timestamps = true;

    public function constants(): HasMany
    {
        return $this->hasMany(Constant::class, 'material_id');
    }
}
