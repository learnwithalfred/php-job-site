<?php
ob_start();
session_start();
include('../../partials/header.php');
include('../../partials/navbar.php');
include('../../configs/constants.php');
include('../../configs/connection.php');

if (isset($_SESSION['user'])) {
  renderToastMessage($_SESSION['user'], 'success');
  unset($_SESSION['user']);
}
if (isset($_SESSION['user_error'])) {
  renderToastMessage($_SESSION['user_error'], 'danger');
  unset($_SESSION['user_error']);
}


$result = mysqli_query($connection, "SELECT * FROM user") or die(mysqlI_error($connection));


?>
<div>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4" style="min-height: 66vh;">
    <div class="flex justify-between items-center">
      <h1 class="p-8 text-3xl font-bold">
        Users
      </h1>
      <a href="new.php" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Add New</a>

    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            #
          </th>
          <th scope="col" class="px-6 py-3">
            user Name
          </th>
          <th scope="col" class="px-6 py-3">
            Email
          </th>

          </th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result) : ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <?php
            $id = $row['id'];
            $fName = $row['full_name'];
            $email = $row['email'];
            ?>
        <tr class="bg-white border-b">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
            <?= $id ?>
          </th>
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
            <?= $fName ?>
          </th>
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
            <?= $email ?>
          </th>
        </tr>
        <?php endwhile; ?>
        <?php else : ?>
        <tr class="bg-white border-b">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
            No User found
          </th>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include('../../partials/footer.php');
ob_end_flush();
?>
