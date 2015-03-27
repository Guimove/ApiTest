<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 27/03/2015
 * Time: 00:32
 */

function getUser($id)
{
    global $app;
    $sql = "SELECT `name`,`email`,`date`,`ip` FROM restAPI WHERE id=:id";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);
        //$stmt->bindParam(':calories', $calories, PDO::PARAM_INT);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $user = $stmt->fetchObject();
        $dbCon = null;
        if ($user) {
            echo json_encode($user);
        } else {
            throw new ResourceNotFoundException();
        }
    } catch (ResourceNotFoundException $e) {
        $app->log->debug("THIS IS ERRROR");
        $app->response()->status(404);
    } catch (PDOException $e) {
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}