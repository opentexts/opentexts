<main role="main" class="container main-container">
    <article class="mx-auto max-w-xl">
        
        <h1>Advanced Search</h1>
        
        <div class="container mx-auto max-w-xl mb-12">
            <form action="/search" method="get">
                <input type="hidden" name="advanced" value="true" />

                <label class="label" for="searchtitle">Title</label>
                <input name="title" type="text" id="searchtitle" class="text-field" value="<?php echo isset($searchtitle) ? $searchtitle : "" ?>" />

                <label class="label" for="searchcreator">Creator</label>
                <input name="creator" type="text" id="searchcreator" class="text-field" value="<?php echo isset($searchcreator) ? $searchcreator : "" ?>" />

                <div class="flex w-full">
                    <div class="mr-1 w-1/2">
                        <label class="label" for="yearfrom">Year From:</label>
                        <input name="yearfrom" type="text" id="yearfrom" class="text-field" value="<?php echo isset($searchyearfrom) ? $searchyearfrom : "" ?>" />
                    </div>

                    <div class="ml-1 w-1/2">
                        <label class="label" for="yearto">Year To:</label>
                        <input name="yearto" type="search" id="yearto" class="text-field" value="<?php echo isset($searchyearto) ? $searchyearto : "" ?>" />
                    </div>
                </div>

                <label class="label" for="searchpublisher">Publisher</label>
                <input name="publisher" type="text" id="searchpublisher" class="text-field" value="<?php echo isset($searchpublisher) ? $searchpublisher : "" ?>" />

                <label class="label" for="searchplaceofpublication">Place of publication</label>
                <input name="placeofpublication" type="text" id="searchplaceofpublication" class="text-field" value="<?php echo isset($searchplaceofpublication) ? $searchplaceofpublication : "" ?>" />

                <label class="label" for="searchformats">Required formats</label>
                
                <div class="flex w-full space-x-3">
                    <input type="checkbox" name="plaintext" class="check-box tick" <?php echo ($searchplaintext == "on") ? "checked" : "" ?>>
                    <span class="label">Plain Text</span>
                </div>
                
                <div class="flex w-full space-x-3">
                    <input type="checkbox" name="iiif" class="check-box tick" <?php echo ($searchiiif == "on") ? "checked" : "" ?>>
                    <span class="label">IIIF</span>
                </div>
                
                <div class="flex w-full space-x-3">
                    <input type="checkbox" name="altoxml" class="check-box tick" <?php echo ($searchaltoxml == "on") ? "checked" : "" ?>>
                    <span class="label">ALTO-XML</span>  
                </div>
                
                <div class="flex w-full space-x-3">
                    <input type="checkbox" name="pdf" class="check-box tick" <?php echo ($searchpdf == "on") ? "checked" : "" ?>>
                    <span class="label">PDF</span>
                </div>
                
                <div class="flex w-full space-x-3">     
                    <input type="checkbox" name="tei" class="check-box tick" <?php echo ($searchtei == "on") ? "checked" : "" ?>>
                    <span class="label">TEI</span>
                </div>
              
                <div class="flex justify-center mt-2">
                    <input class="button-primary px-6" type="submit" value="Search" />
                </div>
                
            </form>
        </div>

    </article>
</main>
