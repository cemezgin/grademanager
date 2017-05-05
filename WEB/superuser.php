<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.03.2016
 * Time: 18:20
 */
session_start();
if(!empty($_SESSION["id"])) {
    if ($_SESSION["tip"] == "1") {
        echo '
<!DOCTYPE html>
<html>
<head><title>Grade Manager System</title>
<link type="text/css" rel="stylesheet" href="jsgrid/jsgrid.min.css">
<link type="text/css" rel="stylesheet" href="jsgrid/jsgrid-theme.min.css">
<link type="text/css" rel="stylesheet" href="semantic/dist/semantic.css">
<script src="jquery.min.js"></script>
<script src="semantic/dist/semantic.js"></script>
<script type="text/javascript" src="jsgrid/jsgrid.min.js"></script>
<script>
$(document).ready(function (){
    $(".menu .item").tab();
});
</script>
<script>
  $(document).ready(function()
  {
    $("#signout").on("click", function () {
          $.ajax({
            type: "GET",
            url: "logout.php",
            cache: false,
            dataType: "json",
            beforeSend: function () {
              $(\'#logout\').addClass(\'loading\');
            },
            success: function (data) {
              if (data["success"] != 1) {
                $(\'#logout\').removeClass(\'loading\');
              }
              else {
                window.location.href = "index.html";
              }
            }
          });
    });
  });

</script>
<script>
$(function(){
$("#show").click(function() {
  var items="<option value=\'\'>Select Course</option>";
  $.getJSON("sprcourses.php",function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.course_code+"\'>"+item.course_code+"-"+item.username+"</option>";
    });
    $("#boxa10").html(items);
  });
});
});
</script>
<script>
$(function(){
var coursecode;
var basliklar;
$("#boxa10").on("change", function() {
coursecode = $(this).val();
var dataString = \'course=\'+coursecode;
var items="<option value=\'\'>Select Section</option>";
  $.getJSON("sprsection.php",dataString,function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.sname+"\'>"+item.sname+"</option>";
    });
    $("#boxa11").html(items);
  });
    });
    $("#boxa11").on("change", function() {
        var sectioncode = $(this).val();
        var dataString = \'course=\'+coursecode + \'&section=\'+sectioncode;
        $.get( "getfields.php", { course: coursecode, section: sectioncode } )
  .done(function( data ) {
    basliklar = data;
    //window.alert(basliklar);
        $("#showmarks").jsGrid({
        width: "100%",
        height: "auto",

        inserting: false,
        paging: false,
        autoload:true,

        controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "sprshowmarks.php",
                        data: dataString
                        //success: success
                    });
                }
            },

        fields: basliklar
    });
  });

    });

    });
</script>
</head>
            <body>
            <div class="four column row">
                     <div class="column">
                        <div class="column">&nbsp;&nbsp;&nbsp;&nbsp;<img class="ui tiny image" src="/media/logoen.jpg"></div>
                     </div>   
                     <div class="column"></div>
                     <div class="column"></div>
                     <div class="column">
                        <div align=\'right\'> <button class="ui grey basic button" id=\'signout\'>Log Out</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                     </div>
            </div></br>
                <div class="ui container">
                    <div class="ui grid">
                        <div class="two wide column">
                            <div class="ui vertical fluid tabular menu">
                                <a class="item" data-tab="1" id="show">
                                    Show Courses
                                </a>
                                <a class="item" href="http://gau.77n.us/sqlback.php">Backup</a>
                            </div>
                            
                        </div>
                        <div class="fourteen wide stretched column" width="150">
                            <div class="ui tab segment active" data-tab="1">
                              <div class="ui form">
                                    <div class="field">
                                        <label>Please Select Course Name</label>
                                        <select class="ui search dropdown" id="boxa10">
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>Please Select Section</label>
                                        <select class="ui search dropdown" id="boxa11">
                                        </select>
                                    </div>
                                </div></br>
                                <div id="showmarks"></div>
                            </div>
                           
                                
                            </div>
                        </div>
                    </div>
                </div>

            </body>
        ';
    }
}