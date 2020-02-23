<?php

//Web service que provee operaciones aritmeticas como mensajes

require_once __DIR__.'/nusoap/nusoap.php';

$server = new nusoap_server();
$server->configureWSDL('Arithmetic', 'ar:ArithmeticWsdl');

function sum($a, $b)
{
    return $a + $b;
}

function diff($a, $b)
{
    return $a - $b;
}

$server->register(
    'Sum',
    array(
        'a' => 'xsd:integer',
        'b' => 'xsd:integer'
    ),
    array('result' => 'xsd:integer'),
    'ar:ArithmeticWsdl',
    'ar:ArithmeticWsdl#Sum'
);

$server->register(
    'Diff',
    array(
        'a' => 'xsd:integer', 
        'b' =>  'xsd:integer'
    ),
    array(
        'result' =>  'xsd:integer'
    ),
    'ar:ArithmeticWsdl',
    'ar:ArithmeticWsdl#Diff'
);

$server->service(file_get_contents("php://input"));