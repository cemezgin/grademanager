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
        if($_SERVER["REQUEST_METHOD"] == GET)
        {
            $coursecode = $_GET["course"];
            $sectioncode = $_GET["section"];
            $stmt = $db->prepare("SELECT class.student_name, grades.g_name  FROM class,grades WHERE class.course=? AND class.section=?");
            $stmt->execute(array($coursecode,$sectioncode));
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($rows)
            {
                header("Content-Type: application/json");
                echo json_encode($rows);
            }
            else
            {
                header("Content-Type: application/json");
                echo json_encode($rows);
            }
        }
        if($_SERVER["REQUEST_METHOD"]== "POST")
        {
            $gradename = $_POST["g_name"];
            $gradeper = $_POST["g_percent"];
            $coursecode = $_POST["course"];
            $sectioncode = $_POST["section"];
            if (isset($coursecode)) {
                $stmt = $db->prepare("INSERT INTO grades(g_name, g_percent, g_course, g_section) VALUES (?, ?, ?, ?)");
                $stmt->execute(array($gradename, $gradeper, $coursecode, $sectioncode));
            }
        }
    }
}