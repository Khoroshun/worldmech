<?php

namespace App\Nova;

use App\Models\Material as MaterialModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Resource;

class Material extends Resource
{
    public static $model = MaterialModel::class;

    public static $title = 'title';

    public static $search = ['id', 'title'];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Title', 'title')
                ->nullable()
                ->rules('max:255'),

            HasMany::make('Constants', 'constants', Constant::class),
        ];
    }

    public static function label() { return 'Materials'; }
    public static function singularLabel() { return 'Material'; }
}
