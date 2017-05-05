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
            $stmt = $db->prepare("SELECT sname FROM sections WHERE course=?");
            $stmt->execute(array($coursecode));
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
            $coursecode = $_POST["course"];
            $section = $_POST["sname"];
            if (isset($section)) {
                $stmt = $db->prepare("SELECT * FROM default_grade ");
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($rows) {
                    foreach ($rows as $row) {
                        //print_r($row);
                        $stmt = $db->prepare("INSERT INTO special_grade(letter_grade, first_grade, last_grade, course, sec) VALUES (?, ?, ?, ?, ?)");
                        $stmt->execute(array($row["letter_grade"], $row["first_grade"], $row["last_grade"], $coursecode, $section));
                    }
                    
                    $stmt = $db->prepare("INSERT INTO sections(course, sname) VALUES (?, ?)");
                    $stmt->execute(array($coursecode, $section));
                }
            }
        }
    }
}