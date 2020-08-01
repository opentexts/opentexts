<form method="get" action="/search" class="container flex flex-col justify-center items-center">
    <label class="block w-full max-w-2xl text-white mb-1 pl-4 text-sm <?php echo isset($q) ? "sr-only" : "" ?>" for="search-input">Search by title, author, date, or subject</label>
    <input type="search" name="q" id="search-input" class="w-full max-w-2xl rounded-full py-4 px-6 text-lg text-slate focus:outline-none focus:border-b-2 focus:border-cyan" value="<?php echo isset($q) ? esc($q) : "" ?>" />
</form>
