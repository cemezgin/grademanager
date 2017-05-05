<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.03.2016
 * Time: 18:24
 */
session_start();
session_destroy();
$json = '{"success": 1}';
echo $json;