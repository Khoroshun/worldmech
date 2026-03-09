<?php

namespace App\Nova;

use App\Models\Constant as ConstantModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Resource;

class Constant extends Resource
{
    public static $model = ConstantModel::class;

    public static $title = 'id';

    public static $search = ['id', 'b', 'd'];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Material', 'material', Material::class)
                ->nullable()
                ->searchable(),

            Number::make('T, K', 'temperature')
                ->step('any')
                ->nullable(),

            Number::make('B (MPa⁻ⁿ/h)', 'b')
                ->step('any')
                ->nullable(),

            Number::make('D (MPa⁻ᵐ/h)', 'd')
                ->step('any')
                ->nullable(),

            Number::make('n')
                ->step('any')
                ->nullable(),

            Number::make('l')
                ->step('any')
                ->nullable(),

            Number::make('m')
                ->step('any')
                ->nullable(),

            Number::make('k')
                ->step('any')
                ->nullable(),

            Number::make('a')
                ->step('any')
                ->nullable(),

            Textarea::make('source')
                ->alwaysShow()
                ->nullable(),
        ];
    }

    public static function label() { return 'Constants'; }
    public static function singularLabel() { return 'Constant'; }
}
