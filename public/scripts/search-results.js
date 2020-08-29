import ResultsController from "./SearchResults/results-controller.js";
import Query from "./SearchResults/Models/query.js";
import FilterViewController from "./SearchResults/ViewControllers/filter-view-controller.js";

/** @type {HTMLTemplateElement} */
const template = document.querySelector("template#result");
/** @type {ResultsController} */
const controller = new ResultsController(template);

const filterViewControllers = Array.from(document.querySelectorAll(".filter")).map(el => new FilterViewController(el, controller));
controller.onResultsAdded.addEventListener(function(){
    document.querySelector("#resultCount").innerText = (controller.getStart()+1) + "-" + controller.getCount();
    document.querySelector("#resultTotal").innerText = controller.getTotal();
    Array.prototype.forEach.call(document.getElementsByClassName("load-more-results"), function(element) {
        if (controller.getCount() >= controller.getTotal()) {
            element.classList.add("invisible");
        }
        element.disabled = false;
        element.innerText = "More results";
        element.classList.remove("bg-opacity-50");
        element.classList.add("bg-opacity-100");
    });
    filterViewControllers.forEach(vc => vc.updateCounts())
});

controller.onResultsRequested.addEventListener(function(){
    Array.prototype.forEach.call(document.getElementsByClassName("load-more-results"), function(element) {
        element.classList.remove("invisible");
        element.disabled = true;
        element.innerText = "Loading...";
        element.classList.remove("bg-opacity-100");
        element.classList.add("bg-opacity-50");
    });
});

document.querySelectorAll(".load-more-results").forEach(function(elem){
    elem.addEventListener("click", controller.fetchMoreResults.bind(controller));
})

globalThis.toggleFilter = function(filter, value){
    var query = controller.getQuery();
    if(query.filterContainsValue(filter, value)) {
        query.removeFromFilter(filter, value);
    } else {
        query.addToFilter(filter, value);
    }
    controller.replaceQuery(query);
}

globalThis.resetFilter = function(filter) {
    var query = controller.getQuery()
    query.resetFilter(filter);
    controller.replaceQuery(query);
}

window.addEventListener('popstate', event => {
    if(event.state){
        /** @type Query */
        const query = new Query(event.state);
        controller.replaceQuery(query, false);
    }
})