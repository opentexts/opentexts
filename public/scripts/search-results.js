import ResultsController from "./SearchResults/results-controller.js";

const template = document.querySelector("template#result");
const controller = new ResultsController(template);

controller.onResultsAdded.addEventListener(function(){
    document.querySelector("#resultCount").innerText = (controller.getStart()+1) + "-" + controller.getCount();
});

document.querySelectorAll(".load-more-results").forEach(function(elem){
    elem.addEventListener("click", controller.fetchMoreResults.bind(controller));
})