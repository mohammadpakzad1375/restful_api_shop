<?php

namespace App\Http\Services\Auth;

use App\Events\Customer\Auth\SendOtp;
use App\Models\Auth\OtpCode;
use Illuminate\Support\Facades\Hash;

class OtpService
{
    //OTP lifetime (minutes)
    private const OTP_TTL = 2;

    //Generate 6 digit OTP
    public function generateOtpCode(): string
    {
        return (string) random_int(111111, 999999);
    }

    //Hash OTP
    public function hashOtpCode(string $code): string
    {
        return Hash::make($code);
    }

    //Create or update OTP and send email
    public function send(string $email): void
    {
        $plainOtp = $this->generateOtpCode();

        OtpCode::updateOrCreate(
            [
                'email' => $email,
            ],
            [
                'code' => $this->hashOtpCode($plainOtp),
                'expires_at' => now()->addMinutes(self::OTP_TTL),
                'used_at' => null,
            ]
        );

        SendOtp::dispatch($plainOtp, $email);
    }

    //Verify OTP
    public function verify(string $email, string $code): array
    {
        $otp = OtpCode::where('email', $email)->first();

        if (!$otp) {

            return [
                'success' => false,
                'message' => 'Invalid OTP.'
            ];
        }

        if ($otp->isExpired()) {

            return [
                'success' => false,
                'message' => 'OTP expired.'
            ];
        }

        if ($otp->isUsed()) {

            return [
                'success' => false,
                'message' => 'OTP already used.'
            ];
        }

        if (!Hash::check($code, $otp->code)) {

            return [
                'success' => false,
                'message' => 'Invalid OTP.'
            ];
        }

        $otp->markAsUsed();

        return [
            'success' => true,
            'message' => 'OTP verified.'
        ];
    }
}
