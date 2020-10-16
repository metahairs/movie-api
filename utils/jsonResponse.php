<?php

class JSONResponse
{
       
    public static function showOkResponse($message)
    {
        header("Content-type: application/json; charset=utf-8");
        header("HTTP/1.1 200 OK");
        
        $output = new stdClass();
        $output->status = '200';
        $output->message = $message;

        echo json_encode($output);
        
        exit();
    }
    
    public static function showKoResponse($message)
    {
        header("Content-type: application/json; charset=utf-8");
        header("HTTP/1.1 422 Unprocessable Entity");
        
        $output = new stdClass();
        $output->status = '422';
        $output->message = $message;

        echo json_encode($output);
        
        exit();
    }
    
    public static function showError($message)
    {
        header("Content-type: application/json; charset=utf-8");
        header("HTTP/1.1 500 Internal Server Error");
        
        $output = new stdClass();
        $output->status = '500';
        $output->message = $message;

        echo json_encode($output);
        
        exit();
    }
    
    public static function showUnknown($message)
    {
        header("Content-type: application/json; charset=utf-8");
        header("HTTP/1.1 400 Bad Request");

        $output = new stdClass();
        $output->status = '400';
        $output->message = $message;

        echo json_encode($output);
         
        exit();
    }
           
}