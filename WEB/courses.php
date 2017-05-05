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
    if ($_SESSION["tip"]=="3")
    {
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $stmt = $db->prepare("SELECT course_code,s_year,semester,course_type FROM courses where lecturer=?");
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
            $coursecode = $_POST["course_code"].'/'.$_POST["semester"].'/'.$_POST["s_year"];
            $coursetype = $_POST["course_type"];
            $semester = $_POST["semester"];
            $year = $_POST["s_year"];
            if (isset($coursecode)) {
                    $stmt = $db->prepare("INSERT INTO courses(course_code, s_year, semester, course_type, lecturer) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute(array($coursecode, $year, $semester, $coursetype, $_SESSION['id']));
                }
            }
    }
    if ($_SESSION["tip"]=="1")
    {
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $stmt = $db->prepare("SELECT course_code,s_year,semester,course_type FROM courses");
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
            $coursecode = $_POST["course_code"].'/'.$_POST["semester"].'/'.$_POST["s_year"];
            $coursetype = $_POST["course_type"];
            $semester = $_POST["semester"];
            $year = $_POST["s_year"];
            if (isset($coursecode)) {
                $stmt = $db->prepare("INSERT INTO courses(course_code, s_year, semester, course_type, lecturer) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute(array($coursecode, $year, $semester, $coursetype, $_SESSION['id']));
            }
        }
    }
}