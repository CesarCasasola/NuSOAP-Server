<?php

require_once __DIR__.'/nusoap/nusoap.php';

$server = new soap_server();
$server->configureWSDL('SaludoXML', 'urn:SaludoXMLwsdl');

function saludar($nombre){
    return 'Hola '. trim($nombre);
}

//Registrar la funcion saludar.
$server->register(
    'Saludar', //nombre del metodo
    array('nombre' => 'xsd:string'), //parametros de entrada
    array('return' => 'xsd:string'), //parametros de salida
    'urn:SaludoXMLwsdl', //nombre del namespace
    'urn:SaludoXMLwsdl#Saludar' //accion soap
);

/*
$HTTP_RAW_POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
$server->service($HTTP_RAW_POST_DATA);
*/
$server->service(file_get_contents("php://input"));

