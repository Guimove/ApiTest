<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 27/03/2015
 * Time: 00:31
 */

function getUsers() {
    global $app;
    $sql = "SELECT `name`,`email`,`date`,`ip` FROM restAPI ORDER BY name";
    try {
        $dbCon = getConnection();
        $stmt   = $dbCon->query($sql);
        $users  = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo json_encode(['users' => $users]);
    } catch(PDOException $e) {
        //http_response_code(500);
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}