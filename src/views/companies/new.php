<?php
ob_start();
session_start();
include('../../partials/header.php');
include('../../partials/navbar.php');
include('../../configs/constants.php');
include('../../configs/connection.php');

if(isset($_SESSION['company_error'])){
  echo $_SESSION['company_error'];
  renderToastMessage($_SESSION['company_error'], "danger");

  unset($_SESSION['company_error']);

}


if (isset($_POST['company_submit'])) {

  $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) :"";
  $address = isset($_POST['address']) ? sanitizeInput($_POST['address']) :"";
  $website = isset($_POST['website']) ? sanitizeInput($_POST['website']) : "";

  if($name && $address && $website){

    $query = "INSERT INTO company(name, address, website) VALUES ('$name','$address','$website')";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if($result){
      $_SESSION['company'] = "Registered Successfully";
      header("Location: index.php");
      exit;


    }else {
      $_SESSION['company_error'] = mysqli_error($connection);

      header("Location: new.php");
      exit;
    }

    

  }
  else{
    renderToastMessage("Please fill in all the fields in the form", "danger");
  }


}






?>
<div class="container sm:px-4" style="min-height: 66vh;">
  <div>
    <section class=" bg-white ">
      <div class=" max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900">Add a company</h2>
        <form action="" method="POST">
          <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="sm:col-span-2">
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Company Name</label>
              <input type="text" name="name" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="company name">
            </div>

            <div class="sm:col-span-2">
              <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
              <input type="text" name="address" id="address"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="Company Address">
            </div>
            <div class="sm:col-span-2">
              <label for="website" class="block mb-2 text-sm font-medium text-gray-900">Website</label>
              <input type="string" name="website" id="website"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="www.company-address.com">
            </div>
            <div class="flex items-center space-x-4">
              <input type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                name="company_submit" value="submit">
            </div>
        </form>
      </div>
    </section>
  </div>


</div>


</div>
<?php
include('../../partials/footer.php');
ob_end_flush();

?>
