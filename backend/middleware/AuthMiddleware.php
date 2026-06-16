<?php
// backend/middleware/AuthMiddleware.php

require_once __DIR__ . '/../config/JwtHandler.php';

class AuthMiddleware {
    public static function verify() {
        // Obtener token del header Authorization
        $headers = getallheaders();
        
        if (!isset($headers['Authorization'])) {
            self::sendUnauthorized("Token no proporcionado");
        }
        
        $authHeader = $headers['Authorization'];
        $token = str_replace('Bearer ', '', $authHeader);
        
        if (empty($token)) {
            self::sendUnauthorized("Token inválido");
        }
        
        $payload = JwtHandler::validate($token);
        
        if (!$payload) {
            self::sendUnauthorized("Token inválido o expirado");
        }
        
        // Guardar datos del usuario para uso posterior
        $_REQUEST['user'] = $payload;
        return $payload;
    }
    
    private static function sendUnauthorized($message) {
        ResponseHelper::error($message, 401);
    }
}