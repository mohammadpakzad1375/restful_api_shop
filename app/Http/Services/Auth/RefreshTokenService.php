<?php

namespace App\Http\Services\Auth;

use App\Models\Auth\RefreshToken;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;

class RefreshTokenService
{
    //Refresh token EXP
    private const REFRESH_TOKEN_TTL = 30;

    //Generate refresh token
    private function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    //Hash refresh token
    private function hashToken(string $token): string
    {
        return hash('sha256', $token);
    }

    //Create new refresh token
    public function create(User $user, ?string $ipAddress = null, ?string $userAgent = null): array {

        $plainToken = $this->generateToken();

        $refreshToken = RefreshToken::create([
            'user_id'=> $user->id,
            'token'=> $this->hashToken($plainToken),
            'ip_address'=> $ipAddress,
            'user_agent'=> $userAgent,
            'expires_at'=> now()->addDays(self::REFRESH_TOKEN_TTL),
            'revoked_at'=> null,
        ]);

        return [
            'plain_text_token' => $plainToken,
            'model' => $refreshToken,
        ];
    }

    //Find valid refresh token
    public function findValid(string $plainToken): RefreshToken|null
    {
        return RefreshToken::active()->where('token', $this->hashToken($plainToken))->first();
    }

   //Rotation
    public function rotate(string $plainToken): string|array
    {
        return DB::transaction(function () use ($plainToken) {

            $refreshToken = RefreshToken::where('token', $this->hashToken($plainToken))
                ->lockForUpdate()
                ->first();

            if (!$refreshToken)
                return 'Invalid refresh token.';

            if ($refreshToken->isExpired())
                return 'Refresh token expired.';

            if ($refreshToken->isRevoked())
                return 'Refresh token revoked.';

            $this->revoke($refreshToken);

            return $this->create(
                $refreshToken->user,
                $refreshToken->ip_address,
                $refreshToken->user_agent
            );
        });
    }

    //Revoke a single refresh token
    public function revoke(RefreshToken $refreshToken): void
    {
        $refreshToken->update([
            'revoked_at' => now(),
        ]);
    }

    //Revoke logged in user
    public function revokeForUser(RefreshToken $refreshToken): void
    {
        if ($refreshToken->user_id === auth('customer')->id())
            $this->revoke($refreshToken);
    }

    //Revoke all refresh tokens for using in logout all devices
    public function revokeAll(User $user): void
    {
        $user->refreshTokens()->active()->update([
                'revoked_at' => now(),
            ]);
    }

    //delete expired and revoked refresh tokens using in a queued job
    public function cleanup()
    {
        return RefreshToken::whereNotNull('revoked_at')
            ->where('expires_at', '<', now())
            ->delete();
    }
}
