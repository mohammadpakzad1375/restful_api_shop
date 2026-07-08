<?php

namespace App\Http\Services\Auth;

use Illuminate\Support\Facades\Hash;

class OtpService
{
    public function generateOtpCode(): string
    {
        return (string) random_int(111111, 999999);
    }

    public function hashOtpCode(string $code): string
    {
        return Hash::make($code);
    }
}
