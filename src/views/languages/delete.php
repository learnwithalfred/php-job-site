<?php
ob_start();
include('../../configs/constants.php');
include('../../configs/connection.php');

if (isset($_GET['id'])) {
  $language_id = $_GET['id'];
} 

// delete language with id
$result = mysqli_query($connection, "DELETE FROM language where id=$language_id") or die(mysqlI_error($connection));

if ($result) {
  $_SESSION['language'] = "language Deleted Successfully";
  header("Location: index.php");
  exit;
} else {
  $_SESSION['language_error'] = mysqli_error($connection);
  header("Location: index.php");
  exit;
}

ob_end_flush();
?>
