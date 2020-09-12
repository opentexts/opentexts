<form method="get" action="/search" class="container flex flex-col justify-center items-center max-w-xl">
    <label class="block w-full text-white mb-1 pl-4 text-sm <?php echo isset($q) ? "sr-only" : "" ?>" for="search-input">Search by title, author, date, or subject</label>

    <div class="w-full bg-white rounded-full flex border-2 border-transparent" onfocusin="this.classList.add('search-focused')" onfocusout="this.classList.remove('search-focused')">
        <input name="q" type="search" id="search-input" class="w-full max-w-2xl py-2 pl-4 pr-8 rounded-full sm:px-1 sm:py-4 sm:pl-6 sm:pr-10 sm:text-lg text-gray-700 focus:outline-none focus:text-blue-700" value="<?php echo isset($q) ? esc($q) : "" ?>" />

        <button class="w-auto items-center text-blue-800 py-1 px-1 my-2 -ml-10 sm:py-2 sm:px-3 sm:mr-2 sm:my-2 sm:-ml-12 rounded-full hover:bg-blue-200 focus:outline-none focus:bg-blue-400">
            <span><?php echo file_get_contents('svg/search.svg'); ?></span>
            <span class="sr-only">Search</span>
        </button>
    </div>
</form>
