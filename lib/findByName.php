<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 27/03/2015
 * Time: 00:33
 */

function findByName($query)
{
    global $app;
    $sql = "SELECT * FROM restAPI WHERE name LIKE :query ORDER BY name";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);
        $query = "%" . $query . "%";
        $stmt->bindParam("query", $query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        if ($users) {
            echo json_encode(['users' => $users]);
        } else {
            throw new ResourceNotFoundException();
        }
    } catch (ResourceNotFoundException $e) {
        $app->response()->status(404);
    } catch (PDOException $e) {
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}