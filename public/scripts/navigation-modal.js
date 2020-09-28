const navToggleButton = document.getElementById('navigation-toggle');
const navModalWrapper = document.getElementById('navigation-modal-wrapper');
const navLinks = Array.from(navModalWrapper.querySelectorAll("li>a"));

function navKeyboardHandler(event){
    let currentIndex = navLinks.indexOf(document.activeElement);
    if(navModalWrapper.classList.contains('modal-closed'))
    {
        if(event.keyCode === 13 || event.keyCode === 32)
        {
            navModalWrapper.classList.remove('modal-closed');
            event.preventDefault();
            setTimeout(() =>navLinks[0].focus(), 200);
        }
    }
    else {
        switch (event.keyCode) {
            case 27:
                navModalWrapper.classList.add('modal-closed');
                navToggleButton.focus();
                event.preventDefault();
                break;
            case 38:
                if (currentIndex > 0) {
                    currentIndex--;
                }
                navLinks[currentIndex].focus();
                event.preventDefault();
                break;
            case 40:
                if (currentIndex < navLinks.length - 1) {
                    currentIndex++;
                }
                navLinks[currentIndex].focus();
                event.preventDefault();
                break;
            case 13:
                var link  = document.activeElement.querySelector("a") || document.activeElement;
                link.click()
                event.preventDefault();
        }
    }
}

navToggleButton.onclick = function(){
    navModalWrapper.classList.toggle('modal-closed');
    navLinks[0].focus();
};

navToggleButton.addEventListener("keydown", navKeyboardHandler);
navModalWrapper.addEventListener("keydown", navKeyboardHandler);

document.getElementById('navigation-close').onclick = function(){
    navModalWrapper.classList.add('modal-closed');
};

function navHandleFocusChange(){
    if(!navModalWrapper.classList.contains('modal-closed') && !navModalWrapper.contains(document.activeElement)) {
        navModalWrapper.classList.add('modal-closed');
    }
}