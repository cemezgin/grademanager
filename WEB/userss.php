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
    if ($_SESSION["tip"]== "4")
    {
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $stmt = $db->prepare("SELECT userid,username,password,tip,email FROM users WHERE NOT userid=?");
            $stmt->execute(array($_SESSION["id"]));
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($rows)
            {
                header("Content-Type: application/json");
                echo json_encode($rows);
            }
        }
        if($_SERVER["REQUEST_METHOD"]== "POST")
        {
            $user = $_POST["userid"];
            $username = $_POST["username"];
            $pass = $_POST["password"];
            $tip = $_POST["tip"];
            $delete = $_POST["delete"];
            $mail = $_POST["email"];
            if($delete == "true")
            {
                    $stmt = $db->prepare("DELETE FROM users WHERE userid=?");
                    $stmt->execute(array($user));
            }
            else
            {
                if (empty($user)) {
                    $stmt = $db->prepare("INSERT INTO users(username, password, tip, email) VALUES (?, ?, ?, ?)");
                    $stmt->execute(array($username,$pass,$tip,$mail));
                }
                else
                {
                    $stmt = $db->prepare("UPDATE users SET username=?, password=?, tip=?, email=? WHERE userid=?");
                    $stmt->execute(array($username,$pass,$tip,$mail,$user));
                }
            }
        }
    }
}