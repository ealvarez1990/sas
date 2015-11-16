<?php
require './clases/AutoCarga.php';


$id_us=  Request::post("id_us");
$dia=  Request::post("dia");
$mes=  Request::post("mes");
$anio=  Request::post("anio");
$Tipo_Id=  Request::post("Tipo_Id");
$dni=  Request::post("dni");
$btSubir=  Request::post("archivo");


echo Filtrar::isInt($id_us);
echo Filtrar::isInt($dia);
echo Filtrar::isInt($mes);
echo Filtrar::isInt($anio);
echo Filtrar::isInt($Tipo_Id);

if((Server::getRequestDate("Y")-$anio)>=14){
    if($dni==NULL || $dni==""){
        echo "Documento de identidad obligatorio";
    }    
}
if(strlen($id_us)<=8){
    echo "Nº de Tarjeta Sanitaria: incorrecto";
}

if($dia<1 || $dia>31){
    echo "Dias entre 1-31";
}

if ($mes<1 || $mes>12){
    echo "Mes entre 1-12";
}

if(strlen($anio)<4){
    echo "Año debe tener 4 cifras";
}

if(strlen($dni)<9){
    echo "DNI debe tenr nueve caracteres";
}

$imagen=new FileUpload("archivo");
$imagen->setStore("img/");
$nombreOriginal=$imagen->getName();
$imagen->setName("_U_".$usuario."_X_".$categoria."_T_".$privada."_C_".$nombreOriginal);
$imagen->getPolicy(FileUpload::RENAME);
$imagen->addType("gif");
$imagen->setSize(52428800);
var_dump($imagen);