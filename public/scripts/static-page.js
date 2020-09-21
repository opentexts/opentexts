
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