<?php 
namespace Modules\Auth\Helpers;
use Illuminate\Support\Facades\Cache;
class RefreshToken{
    public static function make($id,$type){
        $header = json_encode(['iat'=>now()->timestamp,'typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode(['id' => $id, 'type' => $type]);
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, env('JWT_REFRESH_SECRET'), true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        Cache::put('refresh_token_'.$id,$jwt);
        return $jwt;
    }
    private static function base64url_encode($str){
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }
    public static function check($jwt){
        try {
            $tokenParts = explode('.', $jwt);
            $header = base64_decode($tokenParts[0]);
            $payload = base64_decode($tokenParts[1]);
            $signature_provided = $tokenParts[2];
            if (is_null(json_decode($payload))) return "out";
            $base64_url_header = static::base64url_encode($header);
            $base64_url_payload = static::base64url_encode($payload);
            $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, env('JWT_REFRESH_SECRET'), true);
            $base64_url_signature = static::base64url_encode($signature);
            if ($base64_url_signature === $signature_provided) {
                $jwtPayload = (array)json_decode($payload);
                return $jwtPayload;

            }else{
                return "out";
            }
        }catch (\Exception $exception){
            return 'out';
        }
    }
}