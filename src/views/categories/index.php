<?php
ob_start();
session_start();
include('../../partials/header.php');
include('../../partials/navbar.php');
include('../../configs/constants.php');
include('../../configs/connection.php');

if (isset($_SESSION['category'])) {
  renderToastMessage($_SESSION['category'], 'success');
  unset($_SESSION['category']);
}
if (isset($_SESSION['category_error'])) {
  renderToastMessage($_SESSION['category_error'], 'danger');
  unset($_SESSION['category_error']);
}


$result = mysqli_query($connection, "SELECT * FROM category") or die(mysqlI_error($connection));


?>
<div>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4" style="min-height: 66vh;">
    <div class="flex justify-between items-center">
      <h1 class="p-8 text-3xl font-bold">
        Categories
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
            category Name
          </th>
          </th>
          <th scope="col" class="px-6 py-3">
            Action
          </th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result) : ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <?php
            $id = $row['id'];
            $fName = $row['name'];
            ?>
        <tr class="bg-white border-b">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
            <?= $id ?>
          </th>
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
            <?= $fName ?>
          </th>
          <td class="px-6 py-4">
            <a href="show.php?id=<?php echo $id; ?>"
              class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Show</a>
            <a href="edit.php?id=<?php echo $id; ?>"
              class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
            <a href="delete.php?id=<?php echo $id; ?>"
              class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
        <?php else : ?>
        <tr class="bg-white border-b">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
            No Category found
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
