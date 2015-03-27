<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 27/03/2015
 * Time: 00:23
 */
function getConnection() {
    try {
        $db_username = "db_user";
        $db_password = "azerty";
        $conn = new PDO('mysql:host=localhost;dbname=db', $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $conn;
}