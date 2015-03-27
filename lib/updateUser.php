<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 27/03/2015
 * Time: 00:34
 */

function updateUser($id)
{
    global $app;
    $req = $app->request();
    $paramName = $req->params('name');
    $paramEmail = $req->params('email');

    $sql = "UPDATE restAPI SET name=:name, email=:email WHERE id=:id";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);
        $stmt->bindParam("name", $paramName);
        $stmt->bindParam("email", $paramEmail);
        $stmt->bindParam("id", $id);
        $status->status = $stmt->execute();
        $dbCon = null;
        echo json_encode($status);
    } catch (PDOException $e) {
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}