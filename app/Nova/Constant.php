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
            BelongsTo::make('Material', 'material', Material::class)
                ->nullable()
                ->searchable(),

            Number::make('T, K', 'temperature')
                ->step('any')
                ->nullable(),

            Number::make('B (MPa⁻ⁿ/h)', 'b')
                ->step('any')
                ->help('Example: 5.26e-27')
                ->displayUsing(fn($v) => $this->scientific($v))
                ->nullable(),

            Number::make('D (MPa⁻ᵐ/h)', 'd')
                ->step('any')
                ->help('Example: 5.26e-27')
                ->displayUsing(fn($v) => $this->scientific($v))
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

    protected function scientific($value)
    {
        if ($value === null || $value == 0) {
            return $value;
        }

        $exp = floor(log10(abs($value)));
        $mantissa = $value / pow(10, $exp);

        $superscript = [
            '-' => '⁻',
            '0'=>'⁰','1'=>'¹','2'=>'²','3'=>'³','4'=>'⁴',
            '5'=>'⁵','6'=>'⁶','7'=>'⁷','8'=>'⁸','9'=>'⁹'
        ];

        $exp = strtr((string)$exp, $superscript);

        return sprintf('%.3f × 10%s', $mantissa, $exp);
    }
    public static function label() { return 'Constants'; }
    public static function singularLabel() { return 'Constant'; }
}
