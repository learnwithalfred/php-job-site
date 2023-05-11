<?php
ob_start();
include('../../configs/constants.php');
include('../../configs/connection.php');

if (isset($_GET['id'])) {
  $category_id = $_GET['id'];
} 

// delete category with id
$result = mysqli_query($connection, "DELETE FROM category where id=$category_id") or die(mysqlI_error($connection));

if ($result) {
  $_SESSION['category'] = "category Deleted Successfully";
  header("Location: index.php");
  exit;
} else {
  $_SESSION['category_error'] = mysqli_error($connection);
  header("Location: index.php");
  exit;
}

ob_end_flush();
?>
