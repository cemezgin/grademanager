<?php
/**
 * Created by PhpStorm.
 * Date: 20/04/16
 * User: admin
 * Time: 12:05
 */
include "dbconnection.php";
$coursecode = $_GET["course"];
$sectioncode = $_GET["section"];
$stmt = $db->prepare("SELECT grade_id,g_name FROM grades WHERE g_course=? AND g_section=?");
$stmt->execute(array($coursecode,$sectioncode));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($rows)
{
    $yemişler = array(array ("name" => "student_id",
                "title" => "Student ID",
                "type" => "text",
                "width" => "50",
                "validate" => "required"
                ),
                array ("name" => "student_name",
                    "title" => "Student Name",
                    "type" => "text",
                    "width" => "50",
                    "validate" => "required"
                ));
    foreach($rows as $row)
    {
        $yemişler[] =
            array ( "name" => $row["grade_id"],
            "title" => $row["g_name"],
            "type" => "text",
            "width" => "50",
            "validate" => "required"
        );
    }
    $yemişler[] =
        array ( "name" => "avg",
            "title" => "Average Grade",
            "type" => "text",
            "width" => "50",
            "validate" => "required"
        );
    $yemişler[] =
        array ( "name" => "let",
            "title" => "Letter Grade",
            "type" => "text",
            "width" => "50",
            "validate" => "required"
    );
    header("Content-Type: application/json");
    echo json_encode($yemişler);
}
//header("Content-Type: application/json");
//$yemişler = array();
//echo json_encode($yemişler);