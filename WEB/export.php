<?php
/**
 * Created by PhpStorm.
 * Date: 27/04/16
 * Time: 18:03
 * Proje: gau
 */
include "dbconnection.php";
session_start();
if(!empty($_SESSION["id"]))
{
    if ($_SESSION["tip"]== "3")
    {
        
        $stmt = $db->prepare("SELECT grade_id,g_name FROM grades WHERE g_course=? AND g_section=?");
        $stmt->execute(array($coursecode,$sectioncode));
        $sinavlar = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($sinavlar)
        {
            //$examcode = $_GET["e"];
            $stmt = $db->prepare("SELECT class.student_id,class.student_name,marks.mark,marks.exam_id FROM class,marks WHERE class.course=? AND class.section=? AND marks.student_id=class.class_id");
            $stmt->execute(array($coursecode,$sectioncode));
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($rows)
            {
                //letter grade calculation
                foreach($rows as $row)
                {
                    if (array_key_exists($row["student_id"], $yemisler)) {
                        $stmt = $db->prepare("SELECT g_percent, g_deadline, g_check FROM grades WHERE grade_id=?");
                        $stmt->execute(array($row["exam_id"]));
                        $rowlarson = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if($rowlarson){
                            if($rowlarson[0]["g_check"] == "true")
                            {
                                $att[$row["student_id"]] = $row["mark"];
                                $ats[$row["student_id"]] = $rowlarson[0]["g_deadline"];
                            }
                            else {
                                if(!empty($rowlarson[0]["g_deadline"])){
                                    if($row["mark"] < $rowlarson[0]["g_deadline"])
                                    {
                                        $dead[$row["student_id"]] = true;
                                    }
                                    else
                                    {
                                        $dead[$row["student_id"]] = false;
                                    }
                                }
                            }
                            $avg[$row["student_id"]] += ($row["mark"]*$rowlarson[0]["g_percent"])/100;
                            $percent[$row["student_id"]] = $percent[$row["student_id"]]+$rowlarson[0]["g_percent"];
                            $yemisler[$row["student_id"]] += array($row["exam_id"] => $row["mark"]);
                            if($percent[$row["student_id"]] == 100)
                            {
                                $yemisler[$row["student_id"]] += array("avg" => round($avg[$row["student_id"]]));
                                $stmt = $db->prepare("SELECT letter_grade FROM special_grade WHERE course=? AND sec=? AND ? BETWEEN last_grade AND first_grade");
                                $stmt->execute(array($coursecode,$sectioncode,round($avg[$row["student_id"]])));
                                $letter = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                if($letter){
                                    if ($dead[$row["student_id"]])
                                    {
                                        if ($att[$row["student_id"]] < $ats[$row["student_id"]]){
                                            $yemisler[$row["student_id"]] += array("let" => "NG");
                                        }
                                        else {
                                            $yemisler[$row["student_id"]] += array("let" => "F");
                                        }}
                                    else {
                                        $yemisler[$row["student_id"]] += array("let" => $letter[0]["letter_grade"]);
                                    }
                                }
                            }
                        }}else{
                        $stmt = $db->prepare("SELECT g_percent,g_deadline,g_check FROM grades WHERE grade_id=?");
                        $stmt->execute(array($row["exam_id"]));
                        $rowlar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if($rowlar){
                            if($rowlar[0]["g_check"] == "true")
                            {
                                $att[$row["student_id"]] = $row["mark"];
                                $ats[$row["student_id"]] = $rowlar[0]["g_deadline"];
                            }
                            else{
                                if(!empty($rowlar[0]["g_deadline"])){
                                    if($row["mark"] < $rowlar[0]["g_deadline"])
                                    {
                                        $dead[$row["student_id"]] = true;
                                    }
                                    else
                                    {
                                        $dead[$row["student_id"]] = false;
                                    }
                                }
                            }
                            $avg[$row["student_id"]] = ($row["mark"]*$rowlar[0]["g_percent"])/100;
                            $percent[$row["student_id"]] = $rowlar[0]["g_percent"];
                            $yemisler[$row["student_id"]] =
                                array ( "student_id" => $row["student_id"],
                                    "student_name" => $row["student_name"],
                                    $row["exam_id"] => $row["mark"]
                                );
                        }}
                }
                //print_r($yemisler);
                
                echo "<table border=\"1\">
            <tr><th>Student Number</th><th>Student Name</th>";
                foreach ($sinavlar as $sinav)
                {
                    echo '<th>'.$sinav['g_name'].'</th>';

                }
                echo "<th>Average</th><th>Letter</th></tr>";
                foreach ($yemisler as $yemis)
                {
                    echo '
		<tr>
			<td>'.$yemis['student_id'].'</td>
			<td>'.$yemis['student_name'].'</td>';
			foreach ($sinavlar as $sinav)
                {
                    echo '<td>'.$yemis[$sinav[grade_id]].'</td>';
                }
		        echo '<td>'.$yemis['avg'].'</td><td>'.$yemis['let'].'</td></tr>';

                }
                echo "</table>";
                //$citircerez = array_values($yemisler);
                //print_r($citircerez);
                //header("Content-Type: application/json");
                //echo json_encode($citircerez);
            }
            else
            {
                header("Content-Type: application/json");
                echo json_encode($rows);
            }
    }
}}