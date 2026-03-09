<?php

namespace App\Support;

class ScientificFormatter
{
    public static function format($value, $precision = 2)
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

        return sprintf("%.{$precision}f × 10%s", $mantissa, $exp);
    }
}
