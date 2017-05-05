<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 3.04.2016
 * Time: 17:48
 */
session_start();
include "dbconnection.php";
if(!empty($_SESSION["id"]))
{
    echo "
<!DOCTYPE html>
<html>
<title>Grade Manager System</title>
<head>
<link rel=\"stylesheet\" type=\"text/css\" href=\"semantic/dist/semantic.min.css\">
<script src=\"semantic/dist/semantic.min.js\"></script>
<script src=\"jquery.min.js\"></script>
<script>
  $(document).ready(function()
  {
    $(\"#signout\").on(\"click\", function () {
          $.ajax({
            type: \"GET\",
            url: \"logout.php\",
            cache: false,
            dataType: \"json\",
            beforeSend: function () {
              $('#logout').addClass('loading');
            },
            success: function (data) {
              if (data[\"success\"] != 1) {
                $('#logout').removeClass('loading');
              }
              else {
                window.location.href = \"index.html\";
              }
            }
          });
    });
  });
  
</script>

</head>
<body>
";


    if ($_SESSION["tip"]== "3")
    {
        echo "
<div class=\"ui grid\">
<div class=\"ui two column grid\">
  <div class=\"four column row\">
     <div class=\"column\">User Lecturer</div>
     <div class=\"column\"> </div>
     <div class=\"column\"> </div>
     <div class=\"column\"><div align='right'> <button class=\"ui grey basic button\" id='signout'>Log Out</button></div> </div>
   </div> ";
        echo "
  <div class=\"three wide column\" >
  <div class=\"ui vertical menu\">
  <div class=\"item\">
    <div class=\"header\">Class</div>
    <div class=\"menu\">
      <a class=\"item\" href='addclass.php'>Add Class</a>
      <a class=\"item\">Edit Class</a>
    </div>
  </div>
  <div class=\"item\">
    <div class=\"header\">Grades</div>
    <div class=\"menu\">
      <a class=\"item\" href='index.php'>Add/Edit Grade</a>
    </div>
  </div>
  <div class=\"item\">
    <div class=\"header\">Backup</div>
    <div class=\"menu\">
      <a class=\"item\">Old Grades</a>
    </div>
  </div>
  

</div></div>
  <div class=\"column\">
     <div class=\"ui segment\">
   <form class=\"ui form\">
  <div class=\"field\">
    <label>Course Code</label>
    <input type=\"text\" name=\"course-code\" placeholder=\"Course Code\">
  </div>
  <div class=\"field\">
    <label>Semester</label>
    <input type=\"text\" name=\"semester\" placeholder=\"Course Semester/Year\">
  </div>
  <div class=\"grouped fields\">
    <label>Course Type</label>
    <div class=\"field\">
      <div class=\"ui radio checkbox\">
        <input type=\"radio\" name=\"course-type\" checked=\"checked\" id=\"class\">
        <label>Class</label>
      </div>
    </div>
    <div class=\"field\">
      <div class=\"ui radio checkbox\">
        <input type=\"radio\" name=\"course-type\" id=\"Laboratory\">
        <label>Laboratory</label>
      </div>
    </div>
    <div class=\"field\">
      <div class=\"ui radio checkbox\">
        <input type=\"radio\" name=\"course-type\" id=\"Tutorial\">
        <label>Tutorial</label>
      </div>
    </div>
    </div>
    <button class=\"ui button\" type=\"submit\">Submit</button>
  </div>
 
  
</form>
   
  </div>
  
  
</div>
";


    }

}
else {
    echo "Please Log-in First";
}