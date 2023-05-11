<?php
ob_start();
session_start();
include('../../partials/header.php');
include('../../partials/navbar.php');
include('../../configs/constants.php');
include('../../configs/connection.php');


if (isset($_SESSION['language_error'])) {
  renderToastMessage($_SESSION['language_error'], 'danger');
  unset($_SESSION['language_error']);
}



if (isset($_POST['language_submit'])) {
  $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : "";


  // If there are no validation errors, proceed to store the data in the database
  if ($name) {

    $query = "INSERT INTO language(name) VALUES ('$name')";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if ($result) {

      $_SESSION['language'] = "Registration Successfully";

      header("Location: index.php");
      exit;
    } else {
      $_SESSION['language_error'] = mysqli_error($connection);

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
        <h2 class="mb-4 text-xl font-bold text-gray-900">Add a language</h2>
        <form action="" method="POST">
          <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="sm:col-span-2">
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900">language Name</label>
              <input type="text" name="name" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="language name">
            </div>


            <div class="flex items-center space-x-4">
              <input type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                name="language_submit" value="submit">
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
