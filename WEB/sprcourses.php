<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 4.05.2016
 * Time: 20:54
 */
include "dbconnection.php";
session_start();
if(!empty($_SESSION["id"]))
{
    if ($_SESSION["tip"]== "1")
    {
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $stmt = $db->prepare("SELECT course_code,s_year,semester,course_type,username FROM courses,users where lecturer=userid order by lecturer");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($rows)
            {
                header("Content-Type: application/json");
                echo json_encode($rows);
            }
        }
       
        }
    }
