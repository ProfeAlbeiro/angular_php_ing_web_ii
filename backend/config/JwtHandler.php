<?php
// backend/config/JwtHandler.php

class JwtHandler {
    private static $secret = "clave_super_secreta_sena_2026"; // ¡Cambiar por una clave fuerte!
    private static $algorithm = 'HS256';
    
    public static function generate($payload) {
        $header = json_encode(['typ' => 'JWT', 'alg' => self::$algorithm]);
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        
        $payload['iat'] = time(); // Fecha de emisión
        $payload['exp'] = time() + (60 * 60 * 8); // Expira en 8 horas
        
        $jsonPayload = json_encode($payload);
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jsonPayload));
        
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::$secret, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }
    
    public static function validate($token) {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return false;
        }
        
        list($base64UrlHeader, $base64UrlPayload, $base64UrlSignature) = $parts;
        
        // Verificar firma
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::$secret, true);
        $base64UrlCheckSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        
        if ($base64UrlSignature !== $base64UrlCheckSignature) {
            return false;
        }
        
        // Decodificar payload
        $jsonPayload = base64_decode(str_replace(['-', '_'], ['+', '/'], $base64UrlPayload));
        $payload = json_decode($jsonPayload, true);
        
        // Verificar expiración
        if (isset($payload['exp']) && $payload['exp'] < time()) {
            return false;
        }
        
        return $payload;
    }
}