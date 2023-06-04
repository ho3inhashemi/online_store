<?php

function success_response(?object $data , int $status , string $message = '') : object
{
    return response()->json(['data' => $data , 'success' => true , 'status' => $status , 'message' => $message , 'errors' => ''] , $status);
}

function failed_response(?object $data , int $status , string $message = '' , array|string $errors = '') : object
{
    return response()->json(['data' => $data , 'success' => false , 'status' => $status , 'message' => $message , 'errors' => $errors] , $status);
}

?>
