<?php
/**
 * Created by PhpStorm.
 * Date: 27/04/16
 * Time: 00:46
 * Proje: gau
 */
include "dbconnection.php";
$coursetype = "z444";
$stmt = $db->prepare("SELECT * FROM default_grade");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($rows) {
    foreach ($rows as $row) {
        //print_r($row[letter_grade]);
        $stmt = $db->prepare("INSERT INTO special_grade(letter_grade, first_grade, last_grade, course) VALUES (?, ?, ?, ?)");
        $stmt->execute(array($row[letter_grade], $row[first_grade], $row[last_grade], $coursecode));
    }}
