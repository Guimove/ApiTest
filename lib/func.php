<?php
//function __autoload($name)
//{
//    echo "Tentative de chargement de $name.\n";
//    throw new Exception("Impossible de charger $name.");
//}
//
//try {
//    $obj = new NonLoadableClass();
//} catch (Exception $e) {
//    echo $e->getMessage(), "\n";
//}

class ResourceNotFoundException extends Exception
{
}