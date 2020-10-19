<main role="main" class="container main-container">
    <article class="mx-auto max-w-xl">
        
        <div class="container mx-auto max-w-xl mb-12">
            <form action="/search" method="get">
                <input type="hidden" name="advanced" value="true" />

                <label class="block w-full text-blue-800 mb-1 pl-4 pt-6 text-sm" for="searchtitle">Title</label>
                <div class="w-full bg-white rounded-full flex border-transparent search-focused">
                    <input name="title" type="search" id="searchtitle" class="w-full max-w-2xl py-2 pl-4 pr-8 rounded-full sm:px-1 sm:py-4 sm:pl-6 sm:pr-10 sm:text-md text-gray-700 focus:outline-none focus:text-blue-700" value="<?php echo isset($searchtitle) ? esc($searchtitle) : "" ?>" />
                </div>

                <label class="block w-full text-blue-800 mb-1 pl-4 pt-6 text-sm" for="searchcreator">Creator</label>
                <div class="w-full bg-white rounded-full flex border-transparent search-focused">
                    <input name="creator" type="search" id="searchcreator" class="w-full max-w-2xl py-2 pl-4 pr-8 rounded-full sm:px-1 sm:py-4 sm:pl-6 sm:pr-10 sm:text-md text-gray-700 focus:outline-none focus:text-blue-700" value="<?php echo isset($searchcreator) ? esc($searchcreator) : "" ?>" />
                </div>

                <div class="flex mb-4 pt-6">
                    <label class="block w-1/2 text-blue-800 mb-1 pl-4 text-sm" for="yearfrom">Year From:</label>
                    <div class="w-1/2 bg-white rounded-full flex border-transparent search-focused">
                        <input name="yearfrom" type="search" id="yearfrom" class="w-1/2 max-w-2xl py-2 pl-4 pr-8 rounded-full sm:px-1 sm:py-4 sm:pl-6 sm:pr-10 sm:text-md text-gray-700 focus:outline-none focus:text-blue-700" value="<?php echo isset($searchyearfrom) ? esc($searchyearfrom) : "" ?>" />
                    </div>

                    <label class="block w-1/2 text-blue-800 mb-1 pl-4 text-sm" for="yearto">Year To:</label>
                    <div class="w-1/2 bg-white rounded-full flex border-transparent search-focused">
                        <input name="yearto" type="search" id="yearto" class="w-1/2 max-w-2xl py-2 pl-4 pr-8 rounded-full sm:px-1 sm:py-4 sm:pl-6 sm:pr-10 sm:text-md text-gray-700 focus:outline-none focus:text-blue-700" value="<?php echo isset($searchyearto) ? esc($searchyearto) : "" ?>" />
                    </div>
                </div>

                <input type="submit" />

            </form>
        </div>

    </article>
</main>
