<?php
require_once "config.php";

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get'){

} else {
    $array['error'] = 'Method not allowed (only get)';  
}



require_once "return.php";