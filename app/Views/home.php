<main role="main" class="container mx-auto flex flex-col justify-center items-center px-4">

  <img src="/images/logo.svg" class="pt-24 pb-8" alt="Open Texts website logo" />
  <img src="/images/logotype.svg" class="pb-24" alt="Open Texts: Opening up a world of digitised texts" />

  <?php include('templates/search-form.php'); ?>

  <div class="container max-w-xl pt-12 pb-6">
    <h2 class="text-md text-gray-200 mb-4 text-center">Try these searches!</h2>

    <ul class="grid sm:grid-cols-3 gap-10">
      <?php
        //renderSuggestedSearch('medical+report+london', 'medical-reports.svg', 'Medical reports from London');
        renderSuggestedSearch('new+zealand+volcanoes', 'volcanoes.svg', 'Volcanoes in New Zealand');
        renderSuggestedSearch('love+poems', 'love-poems.svg', 'Love poems');
        renderSuggestedSearch('a+midsummer+night%27s+dream', 'midsummer-nights-dream.svg', 'A Midsummer Night’s Dream');
        //renderSuggestedSearch('recipe+book', 'recipe-books.svg', 'Recipe books');
      ?>
      <!--
      <li><a href="https://opentexts.world/search?q=joke+book">Joke books</a></li>
      <li><a href="https://opentexts.world/search?q=greek+antiquities+dictionary">Greek antiquities dictionary</a></li>
      -->
    </ul>
  </div>
</main>
