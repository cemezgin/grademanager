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
            $stmt = $db->prepare("SELECT grade_id,g_name,g_percent,g_deadline,g_check FROM grades WHERE g_course=? AND g_section=?");
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
            $deadline = $_POST["g_deadline"];
            $check = $_POST["g_check"];
            $delete = $_POST["delete"];
            $gid = $_POST["grade_id"];
            if($delete == "true")
            {
                    $stmt = $db->prepare("DELETE FROM grades WHERE grade_id=?");
                    $stmt->execute(array($gid));
            }
            else
            {
                if(empty($gid)) {
                    if (isset($coursecode)) {
                        $stmt = $db->prepare("INSERT INTO grades(g_name, g_percent, g_deadline, g_course, g_section, g_check) VALUES (?, ?, ?, ?, ?, ?)");
                        $stmt->execute(array($gradename, $gradeper, $deadline, $coursecode, $sectioncode, $check));
                        $insert_id = $db->lastInsertId();
                        $stmt = $db->prepare("SELECT student_id,class_id FROM class WHERE class.course=? AND class.section=?");
                        $stmt->execute(array($coursecode,$sectioncode));
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        //print_r($rows);
                        foreach($rows as $row)
                        {
                            $stmt = $db->prepare("INSERT INTO marks(student_id, class_id, section_id, exam_id, mark) VALUES (?, ?, ?, ?, ?)");
                            $stmt->execute(array($row["class_id"], $coursecode, $sectioncode, $insert_id, "0"));
                        }
                    }
                }
                else{
                    $stmt = $db->prepare("UPDATE grades SET g_name=?, g_percent=?, g_deadline=?, g_course=? ,g_section=? ,g_check=? WHERE grade_id=?");
                    $stmt->execute(array($gradename, $gradeper, $deadline, $coursecode, $sectioncode, $check, $gid));
                }
            }

        }
    }
}