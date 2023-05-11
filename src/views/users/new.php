<?php
ob_start();
session_start();
include('../../partials/header.php');
include('../../partials/navbar.php');
include('../../configs/constants.php');
include('../../configs/connection.php');


if (isset($_SESSION['user_error'])) {
  renderToastMessage($_SESSION['user_error'], 'danger');
  unset($_SESSION['user_error']);
}



if (isset($_POST['user_submit'])) {
  $full_name = isset($_POST['full_name']) ? sanitizeInput($_POST['full_name']) : "";
  $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : "";
  $password = isset($_POST['password']) ? sanitizeInput($_POST['password']) : "";

  $full_name = ucwords($full_name);
  $email = strtolower($email);
  

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // If there are no validation errors, proceed to store the data in the database
  if ($full_name && $email && $password) {

    $query = "INSERT INTO user(full_name,email,password) VALUES ('$full_name','$email','$hashed_password' )";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if ($result) {

      $_SESSION['user'] = "Registration Successfully";

      header("Location: index.php");
      exit;
    } else {
      $_SESSION['user_error'] = mysqli_error($connection);

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
        <h2 class="mb-4 text-xl font-bold text-gray-900">Add a user</h2>
        <form action="" method="POST">
          <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="sm:col-span-2">
              <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900">user Name</label>
              <input type="text" name="full_name" id="full_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="user name">
            </div>

            <div class="sm:col-span-2">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900">email</label>
              <input type="text" name="email" id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="user email">
            </div>
            <div class="sm:col-span-2">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900">password</label>
              <input type="password" name="password" id="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="www.user-email.com">
            </div>
            <div class="flex items-center space-x-4">
              <input type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                name="user_submit" value="submit">
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
