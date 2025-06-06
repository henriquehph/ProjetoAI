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

    public static function mapMembershipType(string $input): string
    {
        $input = strtolower(trim($input));

        return match ($input) {
            'pending_member' => 'Pending Activation',
            'board' => 'Board Member',
            'member' => 'Active Member',
            'employee' => 'Employee',
            default => throw new \InvalidArgumentException("Invalid membership type: $input"),
        };
    }

    public static function mapBlocked(string $input): string
    {
        $input = strtolower(trim($input));

        return match ($input) {
            '1' => 'Blcoked',
            '0' => 'Not Blocked',

            default => throw new \InvalidArgumentException("Invalid block type: $input"),
        };
    }

}
