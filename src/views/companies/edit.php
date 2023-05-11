<?php
ob_start();
session_start();
include('../../partials/header.php');
include('../../partials/navbar.php');
include('../../configs/constants.php');
include('../../configs/connection.php');

if (isset($_GET['id'])) {
  $company_id = $_GET['id'];
} else {
  $_SESSION['company'] = "No id provided";

  header("Location: index.php");
}

$result = mysqli_query($connection, "SELECT * FROM company where id=$company_id") or die(mysqlI_error($connection));
$row = mysqli_fetch_array($result);

$name = $row['name'];
$website = $row['website'];
$address = $row['address'];

if (isset($_POST['company_update'])) {
  $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : $row['name'];
  $address = isset($_POST['address']) ? sanitizeInput($_POST['address']) : $row['website'];
  $website = isset($_POST['website']) ? sanitizeInput($_POST['website']) : $row['address'];


  // If there are no validation errors, proceed to store the data in the database
  if ($name && $address && $website) {


    $query = "UPDATE company SET name = '$name', address = '$address', website = '$website' WHERE id = $company_id;";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if ($result) {

      $_SESSION['company'] = "Company Update Successfully";

      header("Location: index.php");
      exit;
    } else {
      $_SESSION['company_error'] = mysqli_error($connection);

      header("Location: new.php");
      exit;
    }
  } else {
    renderToastMessage("Please fill in all the fields", 'danger');
  }
}


?>
<div class="container sm:px-4" style="min-height: 66vh;">
  <div>
    <section class=" bg-white ">
      <div class=" max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900">Edit a <?php echo $name; ?> Company</h2>
        <form action="" method="POST">
          <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="sm:col-span-2">
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Company Name</label>
              <input type="text" name="name" id="name" value="<?php echo $name; ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="company name">
            </div>

            <div class="sm:col-span-2">
              <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
              <input type="text" name="address" id="address" value="<?php echo $address; ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="Company Address">
            </div>
            <div class="sm:col-span-2">
              <label for="website" class="block mb-2 text-sm font-medium text-gray-900">Website</label>
              <input type="string" name="website" id="website" value="<?php echo $website; ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="www.company-address.com">
            </div>
            <div class="flex items-center space-x-4">
              <input type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                name="company_update" value="submit">
            </div>
        </form>
      </div>
    </section>
  </div>


</div>
<?php
include('../../partials/footer.php');
ob_end_flush();
?>
