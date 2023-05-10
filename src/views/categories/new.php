<?php
include('../../partials/header.php');
include('../../partials/navbar.php');
?>
<div class="container sm:px-4" style="min-height: 69vh;">
  <div>
    <section class=" bg-white ">
      <div class=" max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900">Add a Job</h2>
        <form action="" method="POST">
          <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="sm:col-span-2">
              <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Job title</label>
              <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="job title" required="">
            </div>

            <div class="sm:col-span-2">
              <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">job Amount</label>
              <input type="number" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="job Aount" required="">
            </div>
            <div class="sm:col-span-2">
              <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Year</label>
              <input type="string" name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Year" required="">
            </div>
            <input type="hidden" name="creator_id" id="creator_id" value="1">
            <input type="hidden" name="classroom_id" id="creator_id" value="1">

            <div class="flex items-center space-x-4">
              <input type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" name="job_submit" value="submit">

        </form>
      </div>
    </section>
  </div>


</div>
<?php
include('../../partials/footer.php');

?>