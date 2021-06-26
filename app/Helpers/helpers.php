<?php

if (!function_exists('error_details')) {

    function error_details($e, $message)
    {
        if (env('APP_ENV') == 'production') {
            return $message . $e->getMessage();
        } else {
            return $message . 'Error on line ' . $e->getLine() . /*' in ' . $e->getFile() .*/ ' ' . $e->getMessage();
        }

    }
}
