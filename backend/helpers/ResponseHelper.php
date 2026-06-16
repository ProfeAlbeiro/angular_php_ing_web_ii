<?php
// backend/helpers/ResponseHelper.php

class ResponseHelper {
    public static function send($code, $message, $data = null) {
        http_response_code($code);
        echo json_encode([
            'status' => $code,
            'message' => $message,
            'data' => $data
        ]);
        exit;
    }
    
    public static function success($data = null, $message = "Operación exitosa") {
        self::send(200, $message, $data);
    }
    
    public static function created($data = null, $message = "Recurso creado") {
        self::send(201, $message, $data);
    }
    
    public static function error($message = "Error", $code = 400) {
        self::send($code, $message, null);
    }
}