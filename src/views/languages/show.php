<?php
ob_start();
session_start();
include('../../partials/header.php');
include('../../partials/navbar.php');
include('../../configs/constants.php');
include('../../configs/connection.php');

if (isset($_GET['id'])) {
  $language_id = $_GET['id'];
} else {
  echo 'no id';
}

$result = mysqli_query($connection, "SELECT * FROM language where id=$language_id") or die(mysqlI_error($connection));
$row = mysqli_fetch_array($result);

$language_name = $row['name'];
?>

<main class="w-full mx-auto">
  <div class="container sm:px-4" style="min-height: 66vh;">
    <div class="mx-auto max-w-3xl p-4 my-8 border border-gray-200 rounded-lg shadow sm:p-8">
      <div class="flex justify-between items-center">
        <h5 class="mb-2 text-4xl font-extrabold text-gray-900">
          <?= $language_name ?>
        </h5>
        <a href="edit.php?id=<?= $language_id ?>"
          class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
      </div>
    </div>
</main>


<?php
include('../../partials/footer.php');
ob_end_flush();
?>
