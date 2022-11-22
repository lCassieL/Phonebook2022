<?php
class GenerateHeader {
    public static function generateHeader($status, $status_code, $content = null){
        $answer = [];
        $answer["status"] = $status;
        http_response_code($status_code);
        echo $content;
    }
}