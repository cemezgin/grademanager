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
    $forget=1;
    include "dbconnection.php";
    $stmt = $db->prepare("SELECT userid FROM users WHERE userid=? AND forget=?");
    $stmt->execute(array($_SESSION["id"]),$forget);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($rows)
    {
        include "changex.php";
    }
    else
    {
   if ($_SESSION["tip"]== "1")
   {
       include "superuser.php";
   }
        if ($_SESSION["tip"]== "4")
        {
            include "superadmin.php";
        }
   elseif ($_SESSION["tip"]== "2")
   {
       include "admin.php";
   }
   elseif ($_SESSION["tip"]== "3")
   {
       include "lecturer.php";
   }
        
}
}
else
{
    header("Location: http://gau.77n.us/index.html");
    die();
}