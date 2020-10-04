<main role="main" class="container mx-auto flex flex-col justify-center items-center px-4">

  <img src="/images/logo.svg" class="pt-24 pb-8" alt="Logo: a series of nodes connected by lines to form an open circle" />
  <h1 class="sr-only">Open Texts</h1>
  <img src="/images/logotype.svg" class="pb-24" alt="Opening up a world of digitised texts" />

  <?php use App\Models\SuggestedSearch;

  include('templates/search-form.php'); ?>

  <div class="container max-w-xl pt-12 pb-6">
    <h2 class="text-md text-gray-200 mb-4 text-center">Try these searches!</h2>

    <ul class="grid sm:grid-cols-3 gap-10">
      <?php
      $suggestedSearches = array(
          new SuggestedSearch('Medical reports from London', 'medical-reports.svg', 'medical report london'),
          new SuggestedSearch('Volcanoes in New Zealand', 'volcanoes.svg', '"new zealand" volcanoes'),
          new SuggestedSearch('Love poems', 'love-poems.svg', 'love poems'),
          new SuggestedSearch('A Midsummer Night’s Dream', 'midsummer-nights-dream.svg', '"a midsummer night\'s dream"'),
          new SuggestedSearch('Recipe books', 'recipe-books.svg', 'recipe book'),
      );
      for($i = 0; $i < 3; $i++) {
          $index = rand(0, sizeof($suggestedSearches) - 1);
          $search = array_splice($suggestedSearches, $index, 1)[0];
          renderSuggestedSearch($search->searchUrl, $search->icon, $search->label);
      }
      ?>
      <!--
      <li><a href="https://opentexts.world/search?q=joke+book">Joke books</a></li>
      <li><a href="https://opentexts.world/search?q=greek+antiquities+dictionary">Greek antiquities dictionary</a></li>
      -->
    </ul>
  </div>
</main>
