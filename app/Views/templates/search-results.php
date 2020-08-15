<?php
$resultList = array();
foreach ($results as $document) :
    // Highlight search terms in results
    $title = $document->title;
    $creators = $document->creator;
    $publishers = $document->publisher;
    $placesOfPublication = $document->placeOfPublication;
    $highlightedDoc = $highlighted->getResult($document->id);
    
    if ($highlightedDoc) :
        foreach ($highlightedDoc as $field => $highlight):
            if ($field == "title") $title = $highlight[0];
            if ($field == "creator") {
                $creators = array();
                foreach ($highlight as $each) {
                    array_push($creators, $each);
                }
            }
            if ($field == "publisher") {
                $publishers = array();
                foreach ($highlight as $each) {
                    array_push($publishers, $each);
                }
            }
            if ($field == "placeOfPublication") {
                $placesOfPublication = array();
                foreach ($highlight as $each) {
                    array_push($placesOfPublication, $each);
                }
            }
        endforeach;
    endif;

    array_push($resultList, array(
        "title" => $title,
        "creators" => $creators,
        "publishers" => $publishers,
        "placesOfPublication" => $placesOfPublication,
        "urlMain" => $document->urlMain,
        "urlPDF" => $document->urlPDF,
        "urlIIIF" => $document->urlIIIF,
        "urlOther" => $document->urlOther,
        "year" => $document->year
    ));
endforeach;
?>
<div>
<template id="result">
    <div class="container mx-auto max-w-xl mb-8">

        <!-- Title -->
        <h2 class="text-darkCyan text-xl leading-tight mb-1">
            <a rel="bookmark"></a>
        </h2>

        <!-- Author -->
        <span class="text-slate"></span>


        <!-- Publication Information -->
        <span class="text-slate text-opacity-75">
    <!-- Publisher -->
            <!-- Place of publication -->
            <!-- Year of publication -->
</span>

        <!-- Icons for different formats -->
        <div class="inline-flex space-x-1">
            <a><img src="/images/pdf.png" height="16" width="16" /></a>
            <a><img src="/images/logo-iiif-34x30.png" height="16" width="16" /></a>
            <a><img src="/images/txt.png" height="16" width="16" /></a>
        </div>

    </div>

</template>
<script>
    var resultsPayload = <?= json_encode($resultList) ?>;
    var template = document.querySelector("template#result");
    var container = template.parentNode;

    function addResult(result) {
        // TODO: innerHTML usage is bad here, it's needed for highlighting functionality but we should strip tags other than <em>
        var record = template.content.firstElementChild.cloneNode(true);
        var titleNode = record.firstElementChild;
        if(result.urlMain)
        {
            var link = titleNode.firstElementChild;
            link.href = result.urlMain;
            link.innerHTML = result.title;
        }
        else
        {
            titleNode.innerHTML = result.title;
        }

        var author = titleNode.nextElementSibling;
        author.innerHTML = result.creators ? result.creators.join() : "";

        var publisherDetails = author.nextElementSibling;
        var publisherDetailsString = result.publishers ? result.publishers.join(" ") + " " : "";
        publisherDetailsString += result.placesOfPublication ? result.placesOfPublication.join(" ") + " " : "";
        publisherDetailsString += result.year || ""
        publisherDetails.innerHTML = publisherDetailsString;


        var dlIcon = publisherDetails.nextElementSibling.firstElementChild;
        var urls = [result.urlPDF, result.urlIIIF, result.urlOther];
        for(var i = 0; i < 3; i++) {
            if (urls[i]) {
                dlIcon.href = urls[i];
                dlIcon = dlIcon.nextElementSibling;
            } else {
                var icon = dlIcon
                dlIcon = dlIcon.nextElementSibling;
                icon.parentElement.removeChild(icon);
            }
        }
        container.appendChild(record);
    }
    resultsPayload.forEach(addResult);
</script>
</div>
<?php


// Show the search footer, which loads more results and allows users to export their results.
include('search-footer.php');
