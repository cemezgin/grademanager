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
            $coursecode = $_GET["c"];
            $sectioncode = $_GET["s"];
            $examcode = $_GET["e"];
            $stmt = $db->prepare("SELECT class.student_id,class.student_name,marks.mark,marks.mark_id FROM class,marks WHERE class.course=? AND class.section=? AND marks.student_id=class.class_id AND marks.exam_id=?");
            $stmt->execute(array($coursecode,$sectioncode,$examcode));
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
            $markid = $_POST["mark_id"];
            $mark = $_POST["mark"];
            if(!empty($markid)){
                $stmt = $db->prepare("UPDATE marks SET mark=? WHERE mark_id=?");
                $stmt->execute(array($mark,$markid));
            }
        }
    }
}