<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.03.2016
 * Time: 23:56
 */
$username = $_POST["u"];
$password = $_POST["p"];
$email = $_POST["m"];
//$type = $_POST["t"];
include "dbconnection.php";
session_start();
if(!empty($_SESSION["id"]))
{
if ($_SESSION["tip"]== "2")
{
    if (isset($_POST["t"])) {
        $q1 = $_POST["t"];
        $stmt = $db->prepare("INSERT INTO users(username, password, tip,email) VALUES (?, ?, ?,?)");
        $stmt->execute(array($username, $password, $q1,$email));
      
    }
    if ($stmt)
    {
        $json = '{"success": 1}';
        echo $json;
    }
    else
    {
        $json = '{"success": 0}';
        echo $json;
    }
}
    else
    {
        $json = '{"success": 0}';
        echo $json;
    }
}
else
{
    $json = '{"success": 0}';
    echo $json;
}