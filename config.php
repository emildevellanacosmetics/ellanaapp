<?php

/**
 * Configuration for database connection
 *
 */

$host       = "us-cdbr-iron-east-04.cleardb.net";
$username   = "b373f528b8e38d";
$password   = "e6cdc6ea";
$dbname     = "heroku_30c47afc2d3c720";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );