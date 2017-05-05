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
            $stmt = $db->prepare("SELECT student_id,student_name FROM class WHERE course=? AND section=?");
            $stmt->execute(array($coursecode, $sectioncode));
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
            $stdntid = $_POST["student_id"];
            $stdntname = $_POST["student_name"];
            $coursecode = $_POST["course"];
            $section = $_POST["section"];
            if($delete == "true")
            {
                $stmt = $db->prepare("DELETE FROM class WHERE student_id=?");
                $stmt->execute(array($stdntid));
            }
            else {
                if(!empty($stdntid)) {
                
                    $stmt = $db->prepare("INSERT INTO class(student_id, student_name, course, section) VALUES (?, ?, ?, ?)");
                    $stmt->execute(array($stdntid, $stdntname, $coursecode, $section));
                
            }
                else{
                    if (isset($stdntid)) {
                    $stmt = $db->prepare("UPDATE class SET student_id=?, student_name=?, course=?, section=? WHERE student_id=?");
                    $stmt->execute(array($stdntid, $stdntname, $coursecode, $section,$stdntid));
                }}
            }
        }
    }
}