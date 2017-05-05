<?php
/**
 * Created by Admin.
 * Date: 05/05/16
 * Time: 02:31
 * Proje: gau
 */
include "dbconnection.php";
if(isset($_POST["submit"]))
{
    $file = $_FILES['file']['tmp_name'];
    $handle = fopen($file, "r");
    $c = 0;
    while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
    {
        $num = $filesop[0];
        $name = $filesop[1];
        $course = $filesop[2];
        $sec = $filesop[3];

        $stmt = $db->prepare("INSERT INTO class(student_id, student_name, course, section) VALUES (?, ?, ?, ?)");
        $stmt->execute(array($num, $name, $course, $sec));
    }
}