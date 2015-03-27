<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 27/03/2015
 * Time: 00:34
 */

function deleteUser($id)
{
    $sql = "DELETE FROM restAPI WHERE id=:id";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);
        $stmt->bindParam("id", $id);
        $status->status = $stmt->execute();
        $dbCon = null;
        echo json_encode($status);
    } catch (PDOException $e) {
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}
