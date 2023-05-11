<?php
include('../../partials/header.php');
include('../../partials/navbar.php');
?>

<main class="w-full mx-auto">
  <div class="container sm:px-4" style="min-height: 66vh;">
    <div class="mx-auto max-w-3xl p-4 my-8 border border-gray-200 rounded-lg shadow sm:p-8">
      <div class="flex justify-between items-center">
        <h5 class="mb-2 text-4xl font-extrabold text-gray-900">
          <?= $company_name ?>
        </h5>
        <p class="text-xl">
          <a href="<?= $company_website ?>" target="_blank" class="text-blue-700 hover:text-blue-500">
            <?= $company_website ?>
          </a>
        </p>
      </div>
      <div class="text-sm text-gray-600 py-6">
        <p>
          <?= $company_location ?>
        </p>
      </div>
    </div>
  </div>
</main>



<?php
include('../../partials/footer.php');

?>
