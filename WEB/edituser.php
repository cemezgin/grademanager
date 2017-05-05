<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2.04.2016
 * Time: 02:24
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
<link type=\"text/css\" rel=\"stylesheet\" href=\"jsgrid/jsgrid.min.css\">
<link type=\"text/css\" rel=\"stylesheet\" href=\"jsgrid/jsgrid-theme.min.css\">
<link type=\"text/css\" rel=\"stylesheet\" href=\"semantic/dist/semantic.css\">
<script src=\"jquery.min.js\"></script>
<script src=\"semantic/dist/semantic.js\"></script>
<script type=\"text/javascript\" src=\"jsgrid/jsgrid.min.js\"></script>
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


  if ($_SESSION["tip"]== "2")
    {
        echo "
<div class=\"ui grid\">
<div class=\"ui two column grid\">
  <div class=\"four column row\">
     <div class=\"column\">User Admin</div>
     <div class=\"column\"> </div>
     <div class=\"column\"> </div>
     <div class=\"column\"><div align='right'> <button class=\"ui grey basic button\" id='signout'>Log Out</button></div> </div>
   </div> ";
        echo "
  <div class=\"three wide column\" >
  <div class=\"ui vertical menu\">
  <div class=\"item\">
    <div class=\"header\">Users</div>
    <div class=\"menu\">
      <a class=\"item\" href='index.php'>Add User</a>
      <a class=\"item\" href='edituser.php'>Edit/Remove User</a>
    </div>
  </div>
  

</div></div>


  <div class=\"column\">
";

        $sth = $db->prepare("SELECT * FROM users order by tip");
     //   $sth->execute();

        echo " 
 <script>
 $(function() {
 
    $(\"#usertable\").jsGrid({
        height: \"90%\",
        width: \"100%\",
 
        filtering: true,
        editing: true,
        sorting: true,
        paging: true,
        autoload: true,
 
        pageSize: 15,
        pageButtonCount: 5,
 
        deleteConfirm: \"Do you really want to delete the client?\",
 
        controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: \"GET\",
                        url: \"userlist.php\",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: \"POST\",
                        url: \"userlist.php\",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: \"PUT\",
                        url: \"/clients/\",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: \"DELETE\",
                        url: \"/clients/\",
                        data: item
                    });
                }
            },
 
        fields: [
            { name: \"userid\", title:\"User ID\", type: \"number\", width: 50 },
            { name: \"username\", title:\"Username\", type: \"text\", width: 150 },
            { name: \"password\", title:\"Password\", type: \"text\", width: 100 },
            { name: \"tip\", title:\"Type\", type: \"text\", width: 50 },
            { name: \"email\", title:\"E-mail\", type: \"text\", width: 150 },
            { type: \"control\" }
        ]
    });
 
});
 
 </script>
 <div id=\"usertable\"></div>
 <table class=\"ui celled table\">
  <thead>
<tr>
<th></th>
<th>ID</th>
<th>Username</th>
<th>Password</th>
<th>User Type</th>
<th>E-mail</th>
</tr>
</thead>
<tbody>";

            while ( $row = $sth->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo"<td class=\"collapsing\">
                    <div class=\"ui fitted slider checkbox\">
                       <input type=\"radio\" name=\"usercheck\"> <label></label>
                     </div>
                    </td>";
                echo "<td>" . $row['userid'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['tip'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }

        echo "</tbody></table>";
 echo " 
    <div class=\"ui disabled segment\">
   <button class=\"ui inverted blue button\">Edit User</button>
  <button class=\"ui inverted red button\">Delete User</button>
  </div>
</div>
</div>

";
    }

}
else {
    echo "Please Log-in First";
}