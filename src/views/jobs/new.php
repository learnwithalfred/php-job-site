<?php
ob_start();
session_start();
include('../../partials/header.php');
include('../../partials/navbar.php');
include('../../configs/constants.php');
include('../../configs/connection.php');


if (isset($_SESSION['job_error'])) {
  renderToastMessage($_SESSION['job_error'], 'danger');
  unset($_SESSION['job_error']);
}

$category_array = mysqli_query($connection, "SELECT * FROM category") or die(mysqlI_error($connection));
$company_array = mysqli_query($connection, "SELECT * FROM company") or die(mysqlI_error($connection));
$language_array = mysqli_query($connection, "SELECT name FROM language") or die(mysqlI_error($connection));


if (isset($_POST['job_submit'])) {
  



  $title = isset($_POST['title']) ? sanitizeInput($_POST['title']) : "";
  $work_arrangement = isset($_POST['work_arrangement']) ? sanitizeInput($_POST['work_arrangement']) : "";
  $description = isset($_POST['description']) ? sanitizeInput($_POST['description']) : "";
  $salary = isset($_POST['salary']) ? sanitizeInput($_POST['salary']) : "";
  $languages = isset($_POST['languages']) ? $_POST['languages'] : "";
  $category_id = isset($_POST['category_id']) ? sanitizeInput($_POST['category_id']) : "";
  $company_id = isset($_POST['company_id']) ? sanitizeInput($_POST['company_id']) : "";

  $languages = serialize($languages);

  if ($title && $work_arrangement && $description && $salary && $languages && $category_id && $company_id) {
    // Prepare the SQL statement with placeholders
    $query = "INSERT INTO job (title, work_arrangement, description, salary, languages, category_id, company_id)
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
      // Bind the values to the placeholders
      mysqli_stmt_bind_param(
        $stmt,
        "ssssssi",
        $title,
        $work_arrangement,
        $description,
        $salary,
        $languages,
        $category_id,
        $company_id
      );

      // Execute the statement
      $result = mysqli_stmt_execute($stmt);

      if ($result) {
        $_SESSION['job'] = "Job Creation Successfully";
        header("Location: /php-job-site");
        exit;
      } else {
        $_SESSION['job_error'] = mysqli_error($connection);
        header("Location: new.php");
        exit;
      }
    } else {
      $_SESSION['job_error'] = mysqli_error($connection);
      header("Location: new.php");
      exit;
    }
  } else {
    renderToastMessage("Please fill in all the fields", 'danger');
  }
  // if ($title && $work_arrangement && $description && $salary && $languages && $category_id && $company_id) {
  // $languages = serialize($languages);

  // $query = "INSERT INTO job (title, company_id, category_id, languages, work_arrangement, description, salary) VALUES ('$title', $company_id, $category_id, '$languages', '$work_arrangement', '$description', $salary)";

  // $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

  // if ($result) {

  //   $_SESSION['category'] = "Registration Successfully";
  //     header("Location: /php-job-site");

  //   exit;
  // } else {
  //   $_SESSION['category_error'] = mysqli_error($connection);

  //   header("Location: new.php");
  //   exit;
  // }

  // } else {
  //   renderToastMessage("Please fill in all the fields", 'danger');
  // }
}

?>
<div class="container sm:px-4" style="min-height: 66vh;">
  <div>
    <section class=" bg-white ">
      <div class=" max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900">Add a Job</h2>
        <form action="" method="POST">
          <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="sm:col-span-2">
              <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Job Title</label>
              <input type="text" name="title" id="title" required=""
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="job title">
            </div>

            <div class="sm:col-span-2">

              <label for="work_from_home" class="block mb-2 text-sm font-medium text-gray-900">Work from
                Home or office</label>
              <select id="work_from_home" name="work_arrangement"
                class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="">Choose a working arrangement</option>
                <option value="Remote">Remote (Home office)</option>
                <option value="Office">Office</option>
                <option value="Hybrid">Hybrid</option>
              </select>
            </div>

            <div class="sm:col-span-2">
              <label for="salary" class="block mb-2 text-sm font-medium text-gray-900">Salary range in ($)</label>
              <input type="text" name="salary" id="salary"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                placeholder="$200,000.00 - $30,000.00" required="">
            </div>

            <div class="sm:col-span-2">
              <label for="Languages" class="block mb-2 text-sm font-medium text-gray-900" required="">Select
                Languages</label>
              <?php
              if ($language_array) {
                echo '<select name="languages[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" multiple>';
                while ($row = mysqli_fetch_assoc($language_array)) {
                  $language = $row['name'];
                  echo '<option value="' . $language . '">' . $language . '</option>';
                }
                echo '</select>';
              } else {
                echo 'Failed to retrieve languages from the database: ' . mysqli_error($connection);
              }
              ?>
            </div>


            <div class="sm:col-span-2">
              <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Select
                Category
              </label>
              <?php
              if ($category_array) {
                echo '<select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 required=""">';
                while ($row = mysqli_fetch_assoc($category_array)) {
                  $categoryId = $row['id'];
                  $categoryName = $row['name'];
                  echo '<option value="' . $categoryId . '">' . $categoryName . '</option>';
                }
                echo '</select>';
              } else {
                echo 'Failed to retrieve categories from the database: ' . mysqli_error($connection);
              }
              ?>

            </div>

            <div class="sm:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-900">Select
                Company
              </label>
              <?php
              if ($company_array) {
                echo '<select name="company_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">';
                while ($row = mysqli_fetch_assoc($company_array)) {
                  $companyId = $row['id'];
                  $company = $row['name'];
                  echo '<option value="' . $companyId . '">' . $company . '</option>';
                }
                echo '</select>';
              } else {
                echo 'Failed to retrieve categories from the database: ' . mysqli_error($connection);
              }
              ?>

            </div>
            <div class="sm:col-span-2">
              <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Job Description</label>
              <textarea id="description" rows="6" name="description"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                placeholder="Job Description"></textarea>
            </div>
            <div class="flex items-center space-x-4">
              <input type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none"
                name="job_submit" value="submit">
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
