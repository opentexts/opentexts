import {performHomeAnim, renderOpentextsLogo} from "./animation/logo.js";

function detectFocus(){
    navHandleFocusChange();
}

function detectBlur() {
    setTimeout(function() {
        navHandleFocusChange();
    }, 0);
}

window.addEventListener ? window.addEventListener('focus', detectFocus, true) : window.attachEvent('onfocusout', detectFocus);

window.addEventListener ? window.addEventListener('blur', detectBlur, true) : window.attachEvent('onblur', detectBlur);


const logo = document.getElementById("logo");
const logoCtx = logo.getContext("2d");

logo.addEventListener("mouseenter", (evt)=>{
    performHomeAnim(logoCtx, false);
})
logo.addEventListener("mouseleave", (evt)=>{
    performHomeAnim(logoCtx, true);
})
renderOpentextsLogo(logoCtx);