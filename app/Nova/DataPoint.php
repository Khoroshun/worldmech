<?php

namespace App\Nova;

use App\Models\DataPoint as DataPointModel;
use App\Support\ScientificFormatter;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class DataPoint extends Resource
{
    public static $model = DataPointModel::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public static $perPageViaRelationship = 20;

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable()->hideFromIndex(),

            BelongsTo::make('Dataset', 'dataset', Dataset::class)
                ->rules('required'),

            Number::make('X Value', 'x_value')
                ->step(0.0000001)
                ->rules('required', 'numeric'),

            Number::make('Y Value', 'y_value')
                ->step('any')
                ->help('Example: 5.26e-27')
                ->displayUsing(fn($v) => ScientificFormatter::format($v))
                ->rules('required', 'numeric'),
        ];
    }

    public static function label(): string
    {
        return 'Data Points';
    }

    public static function singularLabel(): string
    {
        return 'Data Point';
    }
}

