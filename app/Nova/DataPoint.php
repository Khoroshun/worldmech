<?php

namespace App\Nova;

use App\Models\DataPoint as DataPointModel;
use App\Support\ScientificFormatter;
use Illuminate\Http\Request;
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

    public static function indexQuery(NovaRequest $request, $query): \Illuminate\Contracts\Database\Eloquent\Builder
    {
        return $query->orderBy('x_value', 'desc');
    }

    public function actions(NovaRequest $request)
    {
        return [];
    }

    public function authorizedToView($request)
    {
        return false;
    }

    public function authorizedToDelete($request)
    {
        return false;
    }

    public function fields(NovaRequest $request): array
    {
        $dataset = $this->resource?->dataset;

        $xLabel = $dataset?->x_label . ', ' . $dataset?->x_unit ?? 'X';
        $yLabel = $dataset?->y_label . ', ' . $dataset?->y_unit ?? 'Y';

        return [
            ID::make()->sortable()->hideFromIndex(),

            BelongsTo::make('Dataset', 'dataset', Dataset::class)
                ->rules('required'),

            Number::make($xLabel, 'x_value')
                ->step(0.0000001)
                ->rules('required', 'numeric'),

            Number::make($yLabel, 'y_value')
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

