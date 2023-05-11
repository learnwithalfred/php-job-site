<?php
ob_start();
include('../../configs/constants.php');
include('../../configs/connection.php');

if (isset($_GET['id'])) {
  $company_id = $_GET['id'];
} 

// delete company with id
$result = mysqli_query($connection, "DELETE FROM company where id=$company_id") or die(mysqlI_error($connection));

if ($result) {
  $_SESSION['company'] = "Company Deleted Successfully";
  header("Location: index.php");
  exit;
} else {
  $_SESSION['company_error'] = mysqli_error($connection);
  header("Location: index.php");
  exit;
}

ob_end_flush();
