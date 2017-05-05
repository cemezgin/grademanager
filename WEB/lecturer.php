<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.03.2016
 * Time: 18:20
 */
session_start();
if(!empty($_SESSION["id"]))
{
    if ($_SESSION["tip"]== "3")
    {
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
$(function(){
$("#addx").click(function() {
  var items="<option value=\'\'>Select Course</option>";
  $.getJSON("courses.php",function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.course_code+"\'>"+item.course_code+"</option>";
    });
    $("#boxa1").html(items);
  });
});
});
</script>
<script>
$(function(){
$("#addg").click(function() {
  var items="<option value=\'\'>Select Course</option>";
  $.getJSON("courses.php",function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.course_code+"\'>"+item.course_code+"</option>";
    });
    $("#boxa7").html(items);
  });
});
});
</script>
<script>
$(function(){
$("#addy").click(function() {
  var items="<option value=\'\'>Select Course</option>";
  $.getJSON("courses.php",function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.course_code+"\'>"+item.course_code+"</option>";
    });
    $("#boxa5").html(items);
  });
});
});
</script>
<script>
$(function(){
$("#addz").click(function() {
  var items="<option value=\'\'>Select Course</option>";
  $.getJSON("courses.php",function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.course_code+"\'>"+item.course_code+"</option>";
    });
    $("#boxa3").html(items);
  });
});
});
</script>
<script>
$(function(){
$("#edit").click(function() {
  var items="<option value=\'\'>Select Course</option>";
  $.getJSON("courses.php",function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.course_code+"\'>"+item.course_code+"</option>";
    });
    $("#boxedit").html(items);
  });
});
});
</script>
<script>
$(function(){
$("#boxa4").on("change", function() {
var items="<option value=\'\'>Select Course</option>";
  $.getJSON("courses.php",function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.course_code+"\'>"+item.course_code+"</option>";
    });
    $("#boxa3").html(items);
  });
    });
    });
</script>
<script>
$(function(){
var coursecode;
$("#boxa1").on("change", function() {
coursecode = $(this).val();
var dataString = \'course=\'+coursecode;
var items="<option value=\'\'>Select Section</option>";
  $.getJSON("section.php",dataString,function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.sname+"\'>"+item.sname+"</option>";
    });
    $("#boxa4").html(items);
  });
    });
    $("#boxa4").on("change", function() {
        var sectioncode = $(this).val();
        var dataString = \'course=\'+coursecode + \'&section=\'+sectioncode;
        //window.alert(dataString);
        $("#addclass").jsGrid({
        width: "100%",
        height: "auto",

         inserting: true,
        editing: true,
        paging: false,
        autoload:true,

        controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "class.php",
                        data: dataString
                    });
                },
                insertItem: function(item) {
                    item.course = coursecode;
                    item.section = sectioncode;
                    return $.ajax({
                        type: "POST",
                        url: "class.php",
                        data: item

                    });

                },
                updateItem: function(item) {
                    item.course = coursecode;
                    item.section = sectioncode;
                   
                    return $.ajax({
                        type: "POST",
                        url: "class.php",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    item.delete = true;
                    return $.ajax({
                        type: "POST",
                        url: "class.php",
                        data: item
                    });
                }
            },

        fields: [
            { name: "student_id", title:"Student ID", type: "text", width: 50, validate: "required" },
            { name: "student_name", title:"Student Name", type: "text", width: 50, validate: "required" },
            { type: "control", editButton:true, deleteButton:true, width: 5}
        ]
    });
    });

    });
</script>
<script>
$(function(){
var coursecode;
var sectioncode;
$("#boxa7").on("change", function() {
coursecode = $(this).val();
var dataString = \'course=\'+coursecode;
var items="<option value=\'\'>Select Section</option>";
  $.getJSON("section.php",dataString,function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.sname+"\'>"+item.sname+"</option>";
    });
    $("#boxa8").html(items);
  });
    });
    $("#boxa8").on("change", function() {
    sectioncode = $(this).val();
    var dataString = \'course=\'+coursecode + \'&section=\'+sectioncode;
    var items="<option value=\'\'>Select Section</option>";
  $.getJSON("exams.php",dataString,function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.grade_id+"\'>"+item.g_name+"</option>";
    });
    $("#boxa9").html(items);
  });
    });
    $("#boxa9").on("change", function() {
        var examcode = $(this).val();
        var dataString = \'c=\'+coursecode + \'&s=\'+ sectioncode + \'&e=\' + examcode;
        //window.alert(dataString);
        $("#addgrade").jsGrid({
        width: "100%",
        height: "auto",

        inserting: false,
        editing: true,
        paging: false,
        sorting: true,
        autoload:true,

        controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "marks.php",
                        data: dataString
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "marks.php",
                        data: item
                    });
                }
            },

        fields: [
            { name: "student_id", editing:false, title:"Student ID", type: "text", width: 50},
            { name: "student_name", editing:false, title:"Student Name", type: "text", width: 50},
            { name: "mark", type: "text", title:"Mark", width: 50 },
            { type: "control", editButton:true, deleteButton:false, width: 5}
        ]
    });
    });

    });
</script>
<script>
$(function(){
var coursecode;
$("#boxa5").on("change", function() {
coursecode = $(this).val();
var dataString = \'course=\'+coursecode;
var items="<option value=\'\'>Select Section</option>";
  $.getJSON("section.php",dataString,function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.sname+"\'>"+item.sname+"</option>";
    });
    $("#boxa6").html(items);
  });
    });
    $("#boxa6").on("change", function() {
        var sectioncode = $(this).val();
        var dataString = \'course=\'+coursecode + \'&section=\'+sectioncode;
        //window.alert(dataString);
        $("#addexam").jsGrid({
        width: "100%",
        height: "auto",

        inserting: true,
        editing: true,
        paging: false,
        autoload:true,

        controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "exams.php",
                        data: dataString
                    });
                },
                insertItem: function(item) {
                    item.course = coursecode;
                    item.section = sectioncode;
                    return $.ajax({
                        type: "POST",
                        url: "exams.php",
                        data: item

                    });

                },
                updateItem: function(item) {
                    item.course = coursecode;
                    item.section = sectioncode;
                    return $.ajax({
                        type: "POST",
                        url: "exams.php",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    item.delete = true;
                    return $.ajax({
                        type: "POST",
                        url: "exams.php",
                        data: item
                    });
                }
            },

        fields: [
            { name: "g_name", title:"Title of Exam", type: "text", width: 50, validate: "required" },
            { name: "g_percent", title:"Percentage(%)", type: "text", width: 50 },
            { name: "g_deadline", title:"Condition(If Less than)", type: "text", width: 50 },
            { name: "g_check", type: "checkbox", title: "Attendance", sorting: false },
            { type: "control", editButton:true, deleteButton:true, width: 5}
        ]
    });
    });

    });
</script>

<script>
$(function(){

    });
</script>
<script>
$(function(){
$("#show").click(function() {
  var items="<option value=\'\'>Select Course</option>";
  $.getJSON("courses.php",function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.course_code+"\'>"+item.course_code+"</option>";
    });
    $("#boxa10").html(items);
  });
});
});
</script>
<script>
$(function(){
$("#boxa2").on("change", function() {
        var coursecode = $(this).val();
        var dataString = \'course=\'+coursecode;
        //window.alert(dataString);
        $("#addexam").jsGrid({
        width: "100%",
        height: "auto",

        inserting: true,
        paging: false,
        autoload:true,

        controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "exams.php",
                        data: dataString
                    });
                },
                insertItem: function(item) {
                    item.course = coursecode;
                    return $.ajax({
                        type: "POST",
                        url: "class.php",
                        data: item

                    });

                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "/clients/",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "/clients/",
                        data: item
                    });
                }
            },

        fields: [
            { name: "student_id", title:"Student ID", type: "text", width: 150, validate: "required" },
            { name: "student_name", title:"Student Name", type: "text", width: 50 },
            { type: "control", editButton:false, deleteButton:false, width: 5}
        ]
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
  $.getJSON("section.php",dataString,function(data){
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
        $("#w3s").attr("href", "http://gau.77n.us/ex.php?"+ dataString);
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
                        url: "showmarks.php",
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
<script>
$(function(){
$("#boxa3").on("change", function() {
        var coursecode = $(this).val();
        var dataString = \'course=\'+coursecode;
        //window.alert(dataString);
        $("#addsection").jsGrid({
        width: "100%",
        height: "auto",

        inserting: true,
        paging: false,
        autoload:true,

        controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "section.php",
                        data: dataString
                    });
                },
                insertItem: function(item) {
                    item.course = coursecode;
                    return $.ajax({
                        type: "POST",
                        url: "section.php",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "/clients/",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "/clients/",
                        data: item
                    });
                }
            },

        fields: [
            { name: "sname", title:"Section", type: "text", width: 50, validate: "required" },
            { type: "control", editButton:false, deleteButton:false, width: 5}
        ]
    });
    });
    });
</script>
<script>
$(function(){
var coursecode;
$("#boxedit").on("change", function() {
coursecode = $(this).val();
var dataString = \'course=\'+coursecode;
var items="<option value=\'\'>Select Section</option>";
  $.getJSON("section.php",dataString,function(data){
    $.each(data,function(index,item)
    {
      items+="<option value=\'"+item.sname+"\'>"+item.sname+"</option>";
    });
    $("#boxsonn").html(items);
  });
    });
    $("#boxsonn").on("change", function() {
        var sectioncode = $(this).val();
        var dataString = \'course=\'+coursecode + \'&section=\'+sectioncode;
        //window.alert(dataString);
        $("#editmarks").jsGrid({
        width: "100%",
        height: "auto",

        inserting: false,
        paging: false,
        autoload:true,
        editing:true,

        controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "editmark.php",
                        data: dataString
                    });
                },
                updateItem: function(item) {
                    item.course = coursecode;
                    item.section = sectioncode;
                    return $.ajax({
                        type: "POST",
                        url: "editmark.php",
                        data: item
                    });
                }
            },

        fields: [
            { name: "letter_grade", title:"Letter", type: "text", width: 50, validate: "required" },
            { name: "last_grade", title:"Scale Range", type: "text", width: 50, validate: "required" },
            { name: "first_grade", title:"", type: "text", width: 50, validate: "required" },
            
            { type: "control", editButton:true, deleteButton:false, width: 5}
        ]
    });
    });

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

</head>
            <body>
            <div class="four column row">
                     <div class="column">
                        <div class="column">&nbsp;&nbsp;&nbsp;&nbsp;<img class="ui tiny image" src="/media/logoen.jpg"></div>
                     </div>   
                     <div class="column"></div>
                     <div class="column"></div>
                     <div class="column">
                        <div align=\'right\'> <button class="ui grey basic button" id=\'signout\'>Log Out</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                     </div>
            </div></br>
                <div class="ui container">
                    <div class="ui grid">
                        <div class="two wide column">
                            <div class="ui vertical fluid tabular menu">
                                <a class="item active" data-tab="1">
                                    Add Course
                                </a>
                                <a class="item" data-tab="2" id="addz">
                                    Add Section
                                </a>
                                <a class="item" data-tab="3" id="addx">
                                    Add Class
                                </a>
                                <a class="item" data-tab="4" id="addy">
                                    Evaluate Column
                                </a>
                                <a class="item" data-tab="5" id="addg">
                                    Add Grades
                                </a>
                                 <a class="item" data-tab="6" id="show">
                                    Show Marks
                                </a>
                                <a class="item" data-tab="7" id="edit">
                                    Change Grade Scale
                                </a>
                            </div>
                        </div>
                        <div class="fourteen wide stretched column" width="150">
                        <div class="ui tab segment" data-tab="6">
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
                                <div id="showmarks"></div></br>
                                <a href="" id="w3s">Download Excel</a> 
                                <label>Sayı</label>
                                
                            </div>
                            <div class="ui tab segment active" data-tab="1">
                                <div id="addcourse"></div>
                            </div>
                            <div class="ui tab segment" data-tab="2">
                                <div class="ui form">
                                    <div class="field">
                                        <label>Please Select Course Name</label>
                                        <select class="ui search dropdown" id="boxa3">
                                        </select>
                                    </div>
                                </div></br>
                                <div id="addsection"></div>
                            </div>
                            <div class="ui tab segment" data-tab="3">
                                <div class="ui form">
                                    <div class="field">
                                        <label>Please Select Course Name</label>
                                        <select class="ui search dropdown" id="boxa1">
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>Please Select Section</label>
                                        <select class="ui search dropdown" id="boxa4">
                                        </select>
                                    </div>
                                </div></br>
                                <div id="addclass"></div><br>
                                <form name="import" method="post" enctype="multipart/form-data" action="importt.php">
    	<input type="file" name="file" /><br />
        <input type="submit" name="submit" value="Submit" />
</form>
                            </div>
                            <div class="ui tab segment" data-tab="4">
                            <div class="ui form">
                                    <div class="field">
                                        <label>Please Select Course Name</label>
                                        <select class="ui search dropdown" id="boxa5">
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>Please Select Section</label>
                                        <select class="ui search dropdown" id="boxa6">
                                        </select>
                                    </div>
                                    
                                </div></br>
                                <div id="addexam"></div>
                                *If The Point is less than Condition, Grade Will be directly F.
                            </div>
                            <div class="ui tab segment" data-tab="5">
                            <div class="ui form">
                                    <div class="field">
                                        <label>Please Select Course Name</label>
                                        <select class="ui search dropdown" id="boxa7">
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>Please Select Section</label>
                                        <select class="ui search dropdown" id="boxa8">
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>Please Select Exam</label>
                                        <select class="ui search dropdown" id="boxa9">
                                        </select>
                                    </div>
                                </div></br>
                                <div id="addgrade"></div>
                            </div>
                            <div class="ui tab segment" data-tab="7">
                            <div class="ui form">
                                    <div class="field">
                                        <label>Please Select Course Name</label>
                                        <select class="ui search dropdown" id="boxedit">
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>Please Select Section</label>
                                        <select class="ui search dropdown" id="boxsonn">
                                        </select>
                                    </div>
                                </div></br>
                                <div id="editmarks"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
        $("#addcourse").jsGrid({
        width: "%100",
        height: "auto",

        inserting: true,
        paging: false,
        autoload:true,

        controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "courses.php",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "courses.php",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "/clients/",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "/clients/",
                        data: item
                    });
                }
            },

        fields: [
            { name: "course_code", title:"Course Code", type: "text", width: 50, validate: "required" },
            { name: "s_year", title:"Year", type: "select", items: [{"s_year":"2016-17"},{"s_year":"2017-18"},{"s_year":"2018-19"}], valueField: "s_year", textField: "s_year", width: 50 },
            { name: "semester", title:"Semester", type: "select", items: [{"semester":"Spring"},{"semester":"Fall"},{"semester":"Summer"}], valueField: "semester", textField: "semester", width: 50 },
            { name: "course_type", title:"Course Type", type: "select", items: [{"course_type":"Turorial"},{"course_type":"Class"},{"course_type":"Labarotory"}], valueField: "course_type", textField: "course_type", width: 50 },
            { type: "control", editButton:false, deleteButton:false}
        ]
    });
</script>


            </body>
        ';
    }
}