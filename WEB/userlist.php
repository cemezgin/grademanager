<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 30.04.2016
 * Time: 19:32
 */
include "dbconnection.php";
session_start();
if(!empty($_SESSION["id"]))
{
    if ($_SESSION["tip"]== "2")
    {
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $stmt = $db->prepare("SELECT * FROM users order by tip");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($rows)
            {
                header("Content-Type: application/json");
                echo json_encode($rows);
            }
        }
        if($_SERVER["REQUEST_METHOD"]== "POST")
        {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $type = $_POST["type"];
            $email = $_POST["email"];
            if (isset($username)) {
                $stmt = $db->prepare("INSERT INTO users(username, password, tip, email) VALUES (?, ?, ?, ?)");
                $stmt->execute(array($username,$password,$type,$email));
            }
        }
    }
}