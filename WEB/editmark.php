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
    if ($_SESSION["tip"]== "3")
    {
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $coursecode = $_GET["course"];
            $sectioncode = $_GET["section"];
            $stmt = $db->prepare("SELECT * FROM special_grade WHERE course=? AND sec=?");
            $stmt->execute(array($coursecode, $sectioncode));
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($rows)
            {
                header("Content-Type: application/json");
                echo json_encode($rows);
            }
        }
        if($_SERVER["REQUEST_METHOD"]== "POST")
        {
            $gid = $_POST["id"];
            $coursecode = $_POST["course"];
            $first = $_POST["first_grade"];
            $last = $_POST["last_grade"];
            $sectioncode = $_POST["section"];
            if (isset($coursecode)) {
                if (isset($first)) {
                    $stmt = $db->prepare("UPDATE special_grade SET first_grade=? WHERE id=?");
                    $stmt->execute(array($first, $gid));
                }
                if (isset($last)){
                        $stmt = $db->prepare("UPDATE special_grade SET last_grade=? WHERE id=?");
                        $stmt->execute(array($last, $gid));
                    }
            }
        }
    }
}