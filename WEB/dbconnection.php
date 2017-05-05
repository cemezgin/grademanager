<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.03.2016
 * Time: 17:41
 */

$db = new PDO('mysql:host=127.0.0.1;dbname=dbname;charset=utf8mb4', "db_user","123456", array(PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));