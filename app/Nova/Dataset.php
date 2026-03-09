<?php

namespace App\Nova;

use App\Models\Dataset as DatasetModel;
use Coroowicaksono\ChartJsIntegration\StackedChart;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Dataset extends Resource
{
    public static $model = DatasetModel::class;

    public static $title = 'title';

    public static $search = [
        'id',
        'title',
        'description',
    ];

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable()->hideFromIndex(),

            Text::make('Title')
                ->rules('required', 'max:255')
                ->sortable(),

            Textarea::make('Description')
                ->alwaysShow(),

            Text::make('X Label', 'x_label')
                ->rules('required', 'max:255')
                ->default('Temperature'),

            Text::make('X Unit', 'x_unit')
                ->nullable(),

            Text::make('Y Label', 'y_label')
                ->rules('required', 'max:255'),

            Text::make('Y Unit', 'y_unit')
                ->nullable(),

            Select::make('Scale Type', 'scale_type')
                ->options([
                    'linear' => 'Linear',
                    'log' => 'Logarithmic',
                ])
                ->displayUsingLabels()
                ->rules('required', 'in:linear,log')
                ->sortable()
                ->default('log'),

            HasMany::make('Data Points', 'dataPoints', DataPoint::class),
        ];
    }


    public static function label(): string
    {
        return 'Datasets';
    }

    public static function singularLabel(): string
    {
        return 'Dataset';
    }

    public function cards(Request $request)
    {
        return [
            (new StackedChart())
                ->title('Revenue')
                ->series(array([
                    'barPercentage' => 0.5,
                    'label' => 'Product #1',
                    'backgroundColor' => '#ffcc5c',
                    'data' => [30, 70, 80],
                ],[
                    'barPercentage' => 0.5,
                    'label' => 'Product #2',
                    'backgroundColor' => '#ff6f69',
                    'data' => [40, 62, 79],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => [ 'Jan', 'Feb', 'Mar' ]
                    ],
                ])
                ->width('1/3'),
        ];
    }

}

