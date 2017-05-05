<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.03.2016
 * Time: 17:39
 */
include "dbconnection.php";
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
if (empty($username))
{
    $json = '{"success": 0}';
    echo $json;
}
else {
    if (empty($password))
    {
        $json = '{"success": 0}';
        echo $json;

    }
    else
    {
        $stmt = $db->prepare("SELECT userid,tip FROM users WHERE username=? AND password=?");
        $stmt->execute(array($username, $password));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);



        if ($rows){
            //print_r($rows);
            $json = '{"success": 1}';
            echo $json;
            $_SESSION['tip']= $rows[0]["tip"];
            $_SESSION['id']= $rows[0]["userid"];
        }
        else
        {
            $json = '{"success": 0}';
            echo $json;
        }
    }
}
