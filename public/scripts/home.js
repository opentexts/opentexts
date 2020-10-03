import {loadingSpinnerAnim, performHomeAnim, renderOpentextsLogo, setIsLoading} from "./animation/logo.js";

const logo = document.getElementById("logo");
const logoCtx = logo.getContext("2d");

function startLoadingSpinner(){
    setIsLoading(true);
    loadingSpinnerAnim(logoCtx, -1);
}

document.forms[0].addEventListener('submit', startLoadingSpinner)

document.querySelectorAll("a.suggested-search").forEach(r => {
    r.addEventListener('click', startLoadingSpinner)
})
renderOpentextsLogo(logoCtx);