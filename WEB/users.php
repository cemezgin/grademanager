<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.03.2016
 * Time: 23:56
 */
include "dbconnection.php";
session_start();
if(!empty($_SESSION["id"]))
{
    if ($_SESSION["tip"]== "2")
    {
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            //tabloya yukle
            $stmt = $db->prepare("SELECT userid,username,password,email,tip FROM users WHERE NOT userid=? AND NOT tip=? AND NOT tip=?");
            $stmt->execute(array($_SESSION["id"],2,4));
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($rows)
            {
                header("Content-Type: application/json");
                echo json_encode($rows);
            }
        }
        if($_SERVER["REQUEST_METHOD"]== "POST")
        {
            //tablodan cekilen veriler
            $user = $_POST["userid"];
            $username = $_POST["username"];
            $pass = $_POST["password"];
            $tip = $_POST["tip"];
            $delete = $_POST["delete"];
            $mail = $_POST["email"];
            if($delete == "true")
            {
                if ($tip==2)
                {
                    http_response_code(404);
                }
                else {
                    $stmt = $db->prepare("DELETE FROM users WHERE userid=?");
                    $stmt->execute(array($user));
                }
            }
            else
            {
            if (empty($user)) {
                $stmt = $db->prepare("INSERT INTO users(username, password,email, tip) VALUES (?, ?, ?,?)");
                $stmt->execute(array($username,$pass,$mail,$tip));
            }
            else
            {
                $stmt = $db->prepare("UPDATE users SET username=?, password=?,email=?, tip=? WHERE userid=?");
                $stmt->execute(array($username,$pass,$mail,$tip,$user));
            }
        }
        }
    }
    
}