<?php
class GenerateHeader {
    public static function generateHeader($status, $status_code, $content = null){
        $answer = [];
        $answer["status"] = $status;
        $json = $content;
        header('Content-type: application/json; charset=utf-8');
        http_response_code($status_code);
        echo $json;
    }
}