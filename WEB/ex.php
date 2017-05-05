<?php
/**
 * Created by Admin.
 * Date: 05/05/16
 * Time: 02:04
 * Proje: gau
 */
$coursecode = $_GET["course"];
$sectioncode = $_GET["section"];
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");

// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=codelution-export.xls");

// Add data table
include 'export.php';
?>
