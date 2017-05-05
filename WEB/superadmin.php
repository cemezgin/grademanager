<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.03.2016
 * Time: 18:20
 */
session_start();
if(!empty($_SESSION["id"])) {
    if ($_SESSION["tip"] == "4") {
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
  //logout
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
            <div class="four wide column">
                     <div class="column">
                        <div class="column">&nbsp;&nbsp;&nbsp;&nbsp;<img class="ui tiny image" src="/media/logoen.jpg"></div>
                     </div>   
                     <div class="column">
                        </div>
                     <div class="column"></div>
                     <div class="column">
                        <div align=\'right\'> <button class="ui grey basic button"  id=\'signout\'>Log Out</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</div>
                     </div>
            </div></br>
                <div class="ui container">
                    <div class="ui grid">
                        <div class="two wide column">
                            <div class="ui vertical fluid tabular menu">
                                <a class="item active" data-tab="1">
                                    Superadmin Panel
                                </a>
                            </div>
                        </div>
                        <div class="fourteen wide stretched column" width="150">
                            <div class="ui tab segment active" data-tab="1">
                                <div id="adduser"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
        $("#adduser").jsGrid({
        //ekleme
        width: "%100",
        height: "auto",

        inserting: true,
        paging: false,
        autoload:true,
        editing:true,

        controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "userss.php",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "userss.php",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "userss.php",
                        data: item
                    });
                },
                deleteItem: function(item) {
                item.delete = true;
                    return $.ajax({
                        type: "POST",
                        url: "userss.php",
                        data: item
                    });
                }
            },

        fields: [
            { name: "username", title:"Username", type: "text" , validate: "required"},
            { name: "password", title:"Password", type: "text" , validate: "required"},
            { name: "email", title:"Mail", type: "text" , validate: "required"},
            { name: "tip", title:"Type", type: "select", items: [{ Name: "Superuser", tip: 1 },{ Name: "Admin", tip: 2 },{ Name: "Lecturer", tip: 3 }], valueField: "tip", textField: "Name"},
            { type: "control", editButton:true, deleteButton:true}
        ]
    });
</script>


            </body>
        ';
    }
}