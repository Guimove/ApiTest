<?php

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 27/03/2015
 * Time: 00:33
 */

function addUser()
{
    global $app;
    $input = json_decode($app->request()->getBody());
    $sql = "INSERT INTO restAPI (`name`,`email`,`ip`,`password`,`date`) VALUES (:name, :email, :ip, :password, :dat)";
    try {
        if (!isset($input->name)) {
            throw new Exception('Missing "name" request parameter');
        }
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array(
            ":name" => $input->name,
            ":email" => $input->email,
            ":password" => $input->password,
            ":date" => $input->date,
            ":ip" => $_SERVER['REMOTE_ADDR']
        ));
        $user = $dbCon->lastInsertId();
        $dbCon = null;
        // or $app->redirect('/users')
        echo json_encode($user);
    } catch (PDOException $e) {
        $app->response()->status(500);
        echo json_encode(['error' => ['text' => $e->getMessage()]]);
    }
}