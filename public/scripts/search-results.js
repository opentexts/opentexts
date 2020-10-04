import ResultsController from "./SearchResults/results-controller.js";
import Query from "./SearchResults/Models/query.js";
import FilterViewController from "./SearchResults/ViewControllers/filter-view-controller.js";
import {loadingSpinnerAnim, performHomeAnim, renderOpentextsLogo, setIsLoading} from "./animation/logo.js";

/** @type {HTMLTemplateElement} */
const template = document.querySelector("template#result");
/** @type {ResultsController} */
const controller = new ResultsController(template);

const filterViewControllers = Array.from(document.querySelectorAll(".filter")).map(el => new FilterViewController(el, controller));
const logo = document.getElementById("logo");
const logoCtx = logo.getContext("2d");

/***
 *** Focus handling
 ***/
function detectFocus(){
    filterViewControllers.forEach(fvc => fvc.onFocusChange());
    navHandleFocusChange();
}

function detectBlur() {
    setTimeout(function() {
        filterViewControllers.forEach(fvc => fvc.onFocusChange());
        navHandleFocusChange();
    }, 0);
}
window.addEventListener ? window.addEventListener('focus', detectFocus, true) : window.attachEvent('onfocusout', detectFocus);

window.addEventListener ? window.addEventListener('blur', detectBlur, true) : window.attachEvent('onblur', detectBlur);


/***
 *** Results hooks
 ***/
controller.onResultsAdded.addEventListener(function(){
    setIsLoading(false);
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
    setIsLoading(true);
    loadingSpinnerAnim(logoCtx, -1);
    Array.prototype.forEach.call(document.getElementsByClassName("load-more-results"), function(element) {
        element.classList.remove("invisible");
        element.disabled = true;
        element.innerText = "Loading...";
        element.classList.remove("bg-opacity-100");
        element.classList.add("bg-opacity-50");
    });
});


/***
 *** UI hooks
 ***/
const fetchMoreFunction = controller.fetchMoreResults.bind(controller)
document.querySelectorAll(".load-more-results").forEach(function(elem){
    elem.addEventListener("click", () => fetchMoreFunction(false));
})

const exportLink = document.querySelector("#export");
exportLink.addEventListener('mouseup', (evt) => {
    if(evt.button < 2) {
        exportInteraction()
    }
})
exportLink.addEventListener('keydown', (evt) => {
    if(evt.keyCode === 13) {
        exportInteraction()
    }
})

logo.addEventListener("mouseenter", (evt)=>{
    performHomeAnim(logoCtx, false);
})
logo.addEventListener("mouseleave", (evt)=>{
    performHomeAnim(logoCtx, true);
})
renderOpentextsLogo(logoCtx);

/***
 *** History hooks
 ***/
window.addEventListener('popstate', event => {
    if(event.state){
        /** @type Query */
        const query = new Query(event.state);
        controller.replaceQuery(query, false);
    }
})
