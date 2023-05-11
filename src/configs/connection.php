<?php


$DB_HOST = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = 'root';
$DB_NAME = 'job-website';

$connection = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME) or die(mysqli_error($connection));
mysqli_select_db($connection, $DB_NAME) or die(mysqli_error($connection));
