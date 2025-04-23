<?php

namespace App\FuncoesAux;

use Illuminate\Http\UploadedFile;
class funcoesMap
{
    public static function mapGender(string $input): string
    {

        $input = strtolower(trim($input));

        return match ($input) {
            'male' => 'M',
            'female' => 'F',
            'other' => 'O',
            'm' => 'Male',
            'f' => 'Female',
            'o' => 'Other',
            default => throw new \InvalidArgumentException("Invalid gender: $input"),
        };
    }

    public static function mapPaymentType(string $input): string
    {

        $input = strtolower(trim($input));

        return match ($input) {
            'visa' => 'Visa',
            'paypal' => 'PayPal',
            'mb way' => 'MB WAY',
            default => throw new \InvalidArgumentException("Invalid payment type: $input"),
        };
    }
}