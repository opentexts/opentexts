<form method="get" action="/search" class="container flex flex-col justify-center items-center">
    <label class="block w-full max-w-2xl text-white mb-1 pl-4 text-sm <?php echo isset($q) ? "sr-only" : "" ?>" for="search-input">Search by title, author, date, or subject</label>

    <div class="w-full bg-white max-w-2xl rounded-full flex focus:border-blue-500">
        <input type="search" name="q" id="search-input" class="w-full max-w-2xl rounded-full py-4 px-6 text-lg text-gray-700 focus:outline-none border-2 border-transparent focus:border-blue-500 focus:text-blue-700" value="<?php echo isset($q) ? esc($q) : "" ?>" />

        <button class="w-auto items-center text-blue-800 -ml-12 p-2 pr-4 hover:text-blue-500">
            <span><?php echo file_get_contents('svg/search.svg'); ?></span>
            <span class="sr-only">Search</span>
        </button>
    </div>
</form>
